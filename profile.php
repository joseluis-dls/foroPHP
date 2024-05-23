<?php
// Incluir archivo de conexión a la base de datos
include 'db.php';

// Obtener el ID del usuario desde la URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar datos del usuario
$sql = "SELECT username, email, bio, profile_pic FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No se encontró el usuario.";
    exit;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .profile {
            width: 50%;
            margin: 0 auto;
            text-align: center;
        }
        .profile img {
            border-radius: 50%;
            max-width: 150px;
        }
        .profile h2 {
            font-size: 24px;
            margin: 0.5em 0;
        }
        .profile p {
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="profile">
        <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="Foto de perfil">
        <h2><?php echo htmlspecialchars($user['username']); ?></h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><?php echo nl2br(htmlspecialchars($user['bio'])); ?></p>
    </div>
</body>
</html>
