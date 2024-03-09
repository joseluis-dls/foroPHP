<?php 
require_once('../connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $post_content = $_POST['post_content'];

    if(isset($_SESSION['user_id'])){

        $user_id = $_SESSION["user_id"];
        // Preparar la consulta SQL 
        $query = "INSERT INTO posts (user_id, post_content) VALUES (?, ?);";

        // Preparar la declaración
        if($stmt = $connection -> prepare($query)) {

            // Vincular variables como parámetros
            $stmt -> bind_param("is", $user_id, $post_content);

            if ($stmt -> execute()) {
                echo "Post insertado correctamente";
            } else {
                echo "Error al insertar el post" . $connection -> error;
            }

            // Cerrar la decalaración
            $stmt -> close();
        } else {
            // Error en la preparación de la consulta
            echo "Error en la preparación de la consulta: " . $connection -> error;
        }   
    } else {
        // Si no hay sesión, muestra el mensaje de error
        echo "Error: No hay una sesión de usuario activa";
    }

    $connection -> close();
}

?>