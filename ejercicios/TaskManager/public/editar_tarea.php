<?php
require '../includes/conexion.php';
require_once '../includes/funciones.php';

// Verificar si el usuario está logueado
verificar_sesion();

// Obtener la tarea a editar
if (isset($_GET['id'])) {
    $tarea_id = $_GET['id'];

    // Consultar la tarea
    $sql = "SELECT * FROM tareas WHERE id = ? AND usuario_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tarea_id, $_SESSION['usuario_id']]);
    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tarea) {
        header('Location: index.php');
        exit();
    }

    // Procesar formulario de edición
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = limpiar_datos($_POST['titulo']);
        $descripcion = limpiar_datos($_POST['descripcion']);
        $fecha_limite = limpiar_datos($_POST['fecha_limite']);

        if (!empty($titulo) && !empty($fecha_limite)) {
            $sql = "UPDATE tareas SET titulo = ?, descripcion = ?, fecha_limite = ? WHERE id = ? AND usuario_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$titulo, $descripcion, $fecha_limite, $tarea_id, $_SESSION['usuario_id']]);

            header('Location: index.php');
            exit();
        } else {
            $error = 'Por favor, completa todos los campos.';
        }
    }
} else {
    header('Location: index.php');
    exit();
}

// Incluir el header
include '../layouts/header.php';
?>

<div class="container py-5">
    <h1 class="text-center mb-4">Editar Tarea</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?= htmlspecialchars($tarea['titulo']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4"><?= htmlspecialchars($tarea['descripcion']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="fecha_limite" class="form-label">Fecha Límite</label>
            <input type="date" class="form-control" id="fecha_limite" name="fecha_limite" value="<?= htmlspecialchars($tarea['fecha_limite']); ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar Tarea</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php
// Incluir el footer
include '../layouts/footer.php';
?>