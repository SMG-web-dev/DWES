<?php
require '../includes/conexion.php';
require_once '../includes/funciones.php';

// Verificar si el usuario está logueado
verificar_sesion();

// Borrar tarea
if (isset($_GET['id'])) {
    $tarea_id = $_GET['id'];

    // Consultar si la tarea pertenece al usuario logueado
    $sql = "SELECT * FROM tareas WHERE id = ? AND usuario_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tarea_id, $_SESSION['usuario_id']]);
    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tarea) {
        $sql = "DELETE FROM tareas WHERE id = ? AND usuario_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$tarea_id, $_SESSION['usuario_id']]);

        header('Location: index.php');
        exit();
    } else {
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
