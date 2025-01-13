<?php
require '../includes/conexion.php';
require_once '../includes/funciones.php';

// Verificar si el usuario está logueado
verificar_sesion();

// Procesar formulario de nueva tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = limpiar_datos($_POST['titulo']);
    $descripcion = limpiar_datos($_POST['descripcion']);
    $fecha_limite = limpiar_datos($_POST['fecha_limite']);
    $usuario_id = $_SESSION['usuario_id'];

    if (!empty($titulo) && !empty($fecha_limite)) {
        $sql = "INSERT INTO tareas (titulo, descripcion, fecha_limite, usuario_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titulo, $descripcion, $fecha_limite, $usuario_id]);

        header('Location: index.php');
        exit();
    } else {
        $error = 'Por favor, completa todos los campos.';
    }
}

// Incluir el header
include '../layouts/header.php';
?>

<div class="container py-5">
    <h1 class="text-center mb-4">Nueva Tarea</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="fecha_limite" class="form-label">Fecha Límite</label>
            <input type="date" class="form-control" id="fecha_limite" name="fecha_limite" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar Tarea</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php
// Incluir el footer
include '../layouts/footer.php';
?>