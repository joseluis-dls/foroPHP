<?php
session_start();
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

                $query_pswd = mysqli_prepare($connection, "SELECT password, deleted_at FROM users WHERE password = PASSWORD(?) AND deleted_at IS NULL;");
                mysqli_stmt_bind_param($query_pswd, "s", $pass);
                mysqli_stmt_execute($query_pswd);
                $pswd_result = mysqli_stmt_get_result($query_pswd);

                if (mysqli_num_rows($result) > 0) {
                    $data = mysqli_fetch_array($result);
                    $hashed_password = mysqli_fetch_array($pswd_result);
                    if ($hashed_password['password'] == $data["password"]) {
                        $_SESSION['active'] = true;
                        $_SESSION['user_id'] = $data['user_id'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['rol_id'] = $data['rol_id'];

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
            $name = mysqli_real_escape_string($connection, $_POST['name']);
            $lastName = mysqli_real_escape_string($connection, $_POST['lastName']);
            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

            // Verificar si las contraseñas coinciden
            if ($password != $confirm_password) {
                $alert = "Las contraseñas no coinciden";
            } else {
                // Continuar con la inserción en la base de datos
                $query = "INSERT INTO users (rol_id, username, password, name, lastName, email) 
                        VALUES (2, '$username', PASSWORD('$password'), '$name', '$lastName', '$email')";

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
                <h1>UNESformun</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores libero, voluptatem modi at quidem,
                    velit vero ullam nulla dicta, repudiandae molestiae animi laudantium obcaecati aliquam possimus.
                    Facilis numquam veniam veritatis.</p>
            </div>
        </div>

        <div id="loginFormContainer" class="formLoginDiv">
            <div class="textBienvenida">
                <h3>Bienvenido a</h3>
                <h1>UNESformun</h1>
                <p>Haz login para poder acceder a nuestro contenido.</p>
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
                    Don't have an account yet? <a href="#" id="registerLink">Click here to register</a>.
                </div>
            </form>
        </div>

        <div id="registerFormContainer" class="formLoginDiv">
            <div class="textBienvenida">
                <h3>Bienvenido a</h3>
                <h1>UNESformun</h1>
                <p>Complete el formulario para registrarse.</p>
            </div>

            <form id="RegisterForm" action="" method="post">
                <input type="text" name="name" placeholder="Enter your first name"
                    value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">

                <input type="text" name="lastName" placeholder="Enter your last name"
                    value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>">

                <input type="email" name="email" placeholder="Enter your email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">


                <input type="text" name="username" placeholder="Username"
                    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                <input type="password" name="password" placeholder="Password">

                <input type="password" name="confirm_password" placeholder="Repeat Password">
                <div class="terminos_login">
                    You have an account, <a href="#" id="loginLink">log in</a>.
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