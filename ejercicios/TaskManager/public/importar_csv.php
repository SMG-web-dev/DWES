<?php
require '../includes/conexion.php';
require_once '../includes/funciones.php';

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
        $error = 'No se pudo leer el archivo.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importar Tareas desde CSV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Importar Tareas desde CSV</h1>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="csv" class="form-label">Selecciona el archivo CSV</label>
                <input type="file" class="form-control" id="csv" name="csv" accept=".csv" required>
            </div>
            <button type="submit" class="btn btn-primary">Importar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>