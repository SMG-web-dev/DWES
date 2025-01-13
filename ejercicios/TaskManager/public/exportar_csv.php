<?php
require '../includes/conexion.php';
require_once '../includes/funciones.php';


// Verificar si el usuario está logueado
verificar_sesion();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv'])) {
    $file = $_FILES['csv']['tmp_name'];

    if (($handle = fopen($file, 'r')) !== FALSE) {
        // Saltar encabezados
        fgetcsv($handle);

        // Leer cada línea y agregarla a la base de datos
        while (($data = fgetcsv($handle)) !== FALSE) {
            $titulo = limpiar_datos($data[1]);
            $descripcion = limpiar_datos($data[2]);
            $fecha_limite = limpiar_datos($data[3]);
            $usuario_id = $_SESSION['usuario_id'];

            if (!empty($titulo) && !empty($fecha_limite)) {
                $sql = "INSERT INTO tareas (titulo, descripcion, fecha_limite, usuario_id) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$titulo, $descripcion, $fecha_limite, $usuario_id]);
            }
        }
        fclose($handle);
        header('Location: index.php');
        exit();
    } else {
        $error = 'No se pudo leer el archivo CSV.';
    }
}

// Incluir el header
include '../layouts/header.php';
?>

<div class="container py-5">
    <h1 class="text-center mb-4">Importar Tareas desde CSV</h1>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="csv" class="form-label">Seleccionar archivo CSV</label>
            <input type="file" class="form-control" id="csv" name="csv" required>
        </div>
        <button type="submit" class="btn btn-info">Importar Tareas</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php
// Incluir el footer
include '../layouts/footer.php';
?>