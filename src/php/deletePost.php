<?php
require_once('../connection.php');
session_start();

$postId = $_POST['post_id'];

// Obtener la fecha y hora actual
$current_timestamp = date("Y-m-d H:i:s");

// Actualizar la columna deleted_at en la tabla posts
$queryDeletePost = mysqli_query($connection, "UPDATE posts
                                            SET deleted_at = '$current_timestamp'
                                            WHERE post_id = $postId");

if ($queryDeletePost) {
    echo "Publicación eliminada exitosamente";
} else {
    echo "Error al eliminar";
}
 
?>