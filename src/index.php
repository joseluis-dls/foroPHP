<?php 
    $alert = '';
    session_start();

    if(!empty($_SESSION['active'])){
        header('location: views/principalDashboardView.php');

    }
    else{

        if(!empty($_POST)){
            if(empty($_POST['username']) || empty($_POST['password'])){
                $alert = 'Insert your user and password';
            }
            else{
                require_once "connection.php";
                // Se añade la función de cifrado md5 para la contraseña
                $user = mysqli_real_escape_string($connection, $_POST['username']);
                $pass = md5(mysqli_real_escape_string($connection, $_POST['password']));

                $query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$user' AND password = '$pass' AND deleted_at IS NULL;");
                $result = mysqli_num_rows($query);

                if($result > 0){
                    $data = mysqli_fetch_array($query);
                    print_r($data);
                    $_SESSION['active'] = true;
                    $_SESSION['user_id'] = $data['user_id']; //Los campos deben de llamarse igual que en la BD
                    // $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['rol_id'] = $data['rol_id'];

                    if($data['rol_id'] == 1){
                        header('location: views/principalDashboardView.php');
                    }else if($data['rol_id'] == 2){
                        header('location: main_rol2.php');
                    }
                    
                }
                else{
                    $alert = "El usuario o la clave son incorrectos";
                    session_destroy();

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

    <script src="app.js"></script>
</body>
</html>