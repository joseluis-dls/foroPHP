<?php
require_once "connection.php";

$alert = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validación y procesamiento del formulario
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $lastname = mysqli_real_escape_string($connection, $_POST['lastname']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = md5(mysqli_real_escape_string($connection, $_POST['password']));
    $confirm_password = md5(mysqli_real_escape_string($connection, $_POST['confirm_password']));

    // Verificar si las contraseñas coinciden
    if ($password != $confirm_password) {
        $alert = "Las contraseñas no coinciden";
    } else {
        // Continuar con la inserción en la base de datos
        $query = "INSERT INTO users (rol_id, username, password, name, lastName, email) 
                  VALUES (2, '$username', '$password', '$name', '$lastname', '$email')";

        if (mysqli_query($connection, $query)) {
            $alert = "Usuario registrado exitosamente";
            // Limpia los datos después de un registro exitoso
            $_POST = array();
        } else {
            $alert = "Error al registrar el usuario: " . mysqli_error($connection);
        }
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../src/styles/registerPage.css">
    <title>Registro</title>
</head>

<body>
    <div id="Register">
        <header><strong>Welcome to Registration!</strong></header>

        <form id="RegisterForm" action="" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Enter your first name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">

            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" placeholder="Enter your last name" value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>">

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Enter your email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

            <label for="username">Username</label>
            <input type="text" name="username" placeholder="" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">

            <label for="password">Create your password</label>
            <input type="password" name="password" placeholder="">

            <label for="confirm_password">Confirm your password</label>
            <input type="password" name="confirm_password" placeholder="">

            <div class="buttons">
                <button id="Success" type="submit">Register</button>
            </div>

            <!-- Mostrar alerta -->
            <?php if (!empty($alert)) : ?>
                <div class="alert"><?php echo $alert; ?></div>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>