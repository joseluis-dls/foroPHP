<?php
// Incluir archivo de conexión a la base de datos
include 'db.php';

// Obtener la acción desde la solicitud
$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'add':
        addReaction();
        break;
    case 'remove':
        removeReaction();
        break;
    case 'get':
        getReactions();
        break;
    default:
        echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
        break;
}

function addReaction() {
    global $conn;

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $type = isset($_POST['type']) ? $_POST['type'] : '';

    if ($post_id && $user_id && $type) {
        $sql = "INSERT INTO reactions (post_id, user_id, type) VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE type = VALUES(type)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $post_id, $user_id, $type);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Reacción añadida']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al añadir la reacción']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    }
}

function removeReaction() {
    global $conn;

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;

    if ($post_id && $user_id) {
        $sql = "DELETE FROM reactions WHERE post_id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $post_id, $user_id);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Reacción eliminada']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar la reacción']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    }
}

function getReactions() {
    global $conn;

    echo($conn)

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

    if ($post_id) {
        $sql = "SELECT type, COUNT(*) as count FROM reactions WHERE post_id = ? GROUP BY type";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $reactions = [];
        while ($row = $result->fetch_assoc()) {
            $reactions[$row['type']] = $row['count'];
        }
        echo json_encode(['status' => 'success', 'reactions' => $reactions]);
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    }
}

// Cerrar conexión
$conn->close();
?>
