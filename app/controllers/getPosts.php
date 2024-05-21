<?php
session_start();
require_once "../connection.php";

// Consulta para obtener los posts desde la base de datos
$query = "SELECT p.post_id, p.post_content, p.post_picture, p.posted_at, u.username, u.user_id, u.profile_photo
            FROM posts p
            INNER JOIN users u ON p.user_id = u.user_id
            WHERE p.deleted_at IS NULL
            ORDER BY p.posted_at DESC;";
$result = mysqli_query($connection, $query);

// Verifica si la consulta fue exitosa
if ($result) {
    $posts = array();

    // Itera sobre los resultados y agrega cada post al array
    while ($row = mysqli_fetch_array($result)) {
        $post = array(
            'post_id' => $row['post_id'],
            'post_content' => $row['post_content'],
            'post_picture' => $row['post_picture'],
            'posted_at' => $row['posted_at'],
            'username' => $row['username'],
            'profile_photo' => $row['profile_photo'],
            'session_id' => $_SESSION['user_id'],
            'user_id' => $row['user_id']
        );

        // Consulta para obtener los comentarios asociados al post
        $commentsQuery = "SELECT * FROM comments WHERE post_id = {$row['post_id']} ORDER BY posted_at DESC ";
        $commentsResult = mysqli_query($connection, $commentsQuery);

        $comments = array();
        while($commentRow = mysqli_fetch_assoc($commentsResult)) {
            $comment = array(
                'comment_id' => $commentRow['comment_id'],
                'user_id' => $commentRow['user_id'],
                'comment' => $commentRow['comment'],
                'posted_at' => $commentRow ['posted_at']
            );
            $comments[] = $comment;
        }

        // Agrega los comentarios al post
        $post['comments'] = $comments;

        // Agrega el post al array de posts
        $posts[] = $post;
    }
    
    // Convierte el array de posts a formato JSON
    $jsonResponse = json_encode($posts);

    // Envía el JSON como respuesta a la solicitud de jQuery
    echo $jsonResponse; 
} else {
    // Si hay un error en la consulta, manejarlo adecuadamente
    $error = mysqli_error($connection);
    echo "Error con la consulta: " . $error;
}

// Cierra la conexión con la base de datos
mysqli_close($connection);
