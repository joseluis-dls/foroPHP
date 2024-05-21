<?php session_start();
require_once "connection.php"; // generalizar el acceso a la conexión


if (!empty($_SESSION['active'])) {
    header('location: views/principalDashboardView.php');
    exit();  // Salir para evitar que se siga ejecutando el script después de redirigir
} else {
    $alert = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['loginForm'])) {
            // Procesar el formulario de inicio de sesión
            if (empty($_POST['username']) || empty($_POST['password'])) {
                $alert = 'Insert your user and password';
            } else {

                // Se actualiza el cifrado a bcrypt
                $user = mysqli_real_escape_string($connection, $_POST['username']);
                $pass = mysqli_real_escape_string($connection, $_POST['password']);

                // Consulta preparada para prevenir inyección SQL 
                $query = mysqli_prepare($connection, "SELECT * FROM users WHERE username = ? AND deleted_at IS NULL;");
                mysqli_stmt_bind_param($query, "s", $user);
                mysqli_stmt_execute($query);
                $result = mysqli_stmt_get_result($query);

                if (mysqli_num_rows($result) > 0) {
                    $data = mysqli_fetch_assoc($result);
                    if (password_verify($pass, $data["password"])) {
                        $_SESSION['active'] = true;
                        $_SESSION['user_id'] = $data['user_id'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['rol_id'] = $data['rol_id'];
                        $_SESSION['profile_photo'] = $data['profile_photo'];

                        if ($data['rol_id'] == 1) {
                            header('location: views/principalDashboardView.php');
                            exit(); // Salir después de redirigir
                        } else if ($data['rol_id'] == 2) {
                            header('location: views/principalDashboardView.php');
                            exit(); // Salir después de redirigir
                        }
                    } else {
                        $alert = 'El usuario o la clave son incorrectos';
                        session_destroy();
                    }
                } else {
                    $alert = 'El usuario o la clave son incorrectos';
                    session_destroy();
                }
            }
        } elseif (isset($_POST['registerForm'])) {
            // Validación y procesamiento del formulario
            if (empty($_POST['name']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['username'] || empty($_POST['password'])) || empty($_POST['confirm_password'])) {
                $alert = 'Fill all of the fields';
            } else {
                $name = mysqli_real_escape_string($connection, $_POST['name']);
                $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
                $username = mysqli_real_escape_string($connection, $_POST['username']);
                $email = mysqli_real_escape_string($connection, $_POST['email']);
                $password = mysqli_real_escape_string($connection, $_POST['password']);
                $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

                // Manejar la carga de la imagen de perfil
                if (isset($_FILES["profile_photo"]) && !empty($_FILES["profile_photo"]["name"])){
                    
                    // Obtener el nombre de la imagen
                    $picture_name = $_FILES["profile_photo"]["name"];
                    $full_dir = __DIR__ . "\\img\\users\\" . $picture_name; // ???

                    // Ajusta la ruta relativa para la db
                    $dir = "/foroPHP/src/img/users/" . $picture_name;

                    // Mueve la imagenn al directorio de destino
                    move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $full_dir);

                } else {
                    // Si el usuario no carga una imagen, usa una imagen por defecto
                    $dir = "/foroPHP/src/img/default/default_user.jpg";
                 }

                // Verificar si las contraseñas coinciden
                if ($password != $confirm_password) {
                    $alert = "Las contraseñas no coinciden";
                } else {
                    $hashed_password = password_hash(mysqli_real_escape_string($connection, $_POST['password']), PASSWORD_DEFAULT);
    
                    // Continuar con la inserción en la base de datos
                    $query = "INSERT INTO users (rol_id, username, password, name, lastName, email, profile_photo) 
                            VALUES (2, '$username', '$hashed_password', '$name', '$lastName', '$email', '$dir')";
    
                    if (mysqli_query($connection, $query)) {
                        $alert = "Usuario registrado exitosamente";
                        // Limpia los datos después de un registro exitoso
                        $_POST = array();
                    } else {
                        $alert = "Error al registrar el usuario: " . mysqli_error($connection);
                    }
            }
 
            }

        }
    }


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/c7fad14ccd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles/styleIndex.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoRS.png" />
    <title>UNESforum</title>

    <style>
        #registerFormContainer {
            display: none;
        }
    </style>
</head>

<body>
    <div id="Login">
        <div class="presentationLoginDiv">
            <div class="centroTextoImagen">
                <img src="./img/logoUnesForum.png" alt="">
                <p>UNESforum es el lugar indicado para poder expresarte, si tienes algo que decir siempre habra gente que quiera escuchar.</p>
            </div>
        </div>

        <div id="loginFormContainer" class="formLoginDiv">
            <div class="textBienvenida">
                <h3>Bienvenido a</h3>
                <h1>UNESforum</h1>
                <p>¡Inicia sesión!</p>
            </div>

            <form id="LoginForm" action="" method="post">
                <div class="alert">
                    <?php echo isset($alert) ? $alert : ''; ?>
                </div>
                <input type="text" name="username" placeholder="Username">

                <input type="password" name="password" placeholder="Password">

                <div class="buttons">
                    <button id="Succes" type="submit" name="loginForm">Log in</button>
                </div>

                <div class="terminos">
                    ¿No tienes cuenta todavía? <a href="#" id="registerLink">Regístrate</a>.
                </div>
            </form>
        </div>

        <div id="registerFormContainer" class="formLoginDiv">
            <div class="textBienvenida">
                <h3>Bienvenido a</h3>
                <h1>UNESforum</h1>
                <p>Ingresa tus datos:</p>
            </div>

            <form id="RegisterForm" method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">

                <input type="text" name="lastName" placeholder="Last Name" value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>">

                <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">


                <input type="text" name="username" placeholder="Username"
                    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

                <input type="file" name="profile_photo" id="profile_photo">

                <input type="password" name="password" placeholder="Password">

                <input type="password" name="confirm_password" placeholder="Confirm Password">
                <div class="terminos_login">
                    ¿Ya tienes cuenta? <a href="#" id="loginLink">Inicia sesión</a>.
                </div>
                <div class="button_register">
                    <button id="Success" type="submit" name="registerForm">Register</button>
                </div>

                <!-- Mostrar alerta -->
                <?php if (!empty($alert)): ?>
                    <div class="alert">
                        <?php echo $alert; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('registerLink').addEventListener('click', function (e) {
            e.preventDefault(); // Evita que el enlace redireccione a otra página

            // Oculta el formulario de inicio de sesión y muestra el formulario de registro
            document.getElementById('loginFormContainer').style.display = 'none';
            document.getElementById('registerFormContainer').style.display = 'block';
        });

        document.getElementById("loginLink").addEventListener("click", function (e) {
            document.getElementById('loginFormContainer').style.display = 'block';
            document.getElementById('registerFormContainer').style.display = 'none';
        })
    </script>
</body>

</html>