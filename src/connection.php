<?php
    $host = 'localhost';
    $user = 'paco';
    $password = '2754';
    $db = 'forum';
    $port = '3307';
    $connection = @mysqli_connect($host, $user, $password, $db, $port);
    if(!$connection){
        echo "Error en la conexión";
    }
?>
