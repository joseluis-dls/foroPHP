<?php 

require_once("../connection.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['commentForm'])) { // Adecuar los nombres de POST con los que se pongan en el HTML
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
        $comment_text = $_POST['comment_text'];

        // Validar y sanitizar los datos del formulario según sea necesario

        // Insetar el comentario en la base de datos
        $query = "INSERT INTO comments (user_id, post_id, comment) VALUES (?, ?, ?); ";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "iis", $user_id, $post_id, $comment_text);

        if (mysqli_stmt_execute($stmt)) {
            // Éxito al insertar el comentario
            echo "Comentario añadido exitosamente";
        } else {
            echo "Error al insertar comentario: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($connection);