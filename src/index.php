<?php 
    $alert = '';
    session_start();

    if(!empty($_SESSION['active'])){
        header('location: views/principalDashboardView.php');
        exit();  // Salir para evitar que se siga ejecutando el script después de redirigir
    }
    else{

        if(!empty($_POST)){
            if(empty($_POST['username']) || empty($_POST['password'])){
                $alert = 'Insert your user and password';
            }
            else{
                require_once "connection.php";

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

                if(mysqli_num_rows($result) > 0){
                    $data = mysqli_fetch_array($result);
                    $hashed_password = mysqli_fetch_array($pswd_result);
                    if($hashed_password['password'] == $data["password"]) { // Verificar la contraseña con password_verify()
                        $_SESSION['active'] = true;
                        $_SESSION['user_id'] = $data['user_id'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['rol_id'] = $data['rol_id'];

                        if($data['rol_id'] == 1){
                            header('location: views/principalDashboardView.php');
                            exit(); // Salir después de redirigir
                        } else if($data['rol_id'] == 2){
                            header('location: main_rol2.php');
                            exit(); // Salir después de redirigir
                        }
                    } else {
                        $alert = "El usuario o la clave son incorrectos";
                    }
                }
                else{
                    $alert = "El usuario o la clave son incorrectos";
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
    <link rel="shortcut icon" href="img/LogoRS.png"/>
    <title>UNESforum</title>
</head>
<body>
    <div id="Login">
        <header><strong>Hello there!</strong></header>
        
        <form id="LoginForm" action="" method="post">
        <div class="alert"><?php echo isset ($alert) ? $alert : '';  ?></div>

            <label for="Usuario" >User</label>
            <input type="text" name="username" >
            <label for="Password">Password</label>
            <input type="password" name="password" >
            
            <div class="buttons">
                <button id = "Succes" type="submit" >Log in</button>
            </div>

            <div class="terminos">
                Don't have an account yet? <a href="registerPage.php" target="_blank">Click here to register</a>.
            </div>

        </form>
    </div>

</body>
</html>