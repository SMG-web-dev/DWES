<?php
require '../includes/conexion.php';
require_once '../includes/funciones.php';

// Verificar si el usuario está logueado
verificar_sesion();

// Obtener las tareas del usuario logueado
$sql = "SELECT * FROM tareas WHERE usuario_id = ? ORDER BY fecha_limite ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['usuario_id']]);
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../layouts/header.php';
?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h1 class="display-4">Mis Tareas</h1>
            <p class="lead text-muted">Administra tus tareas de manera fácil y eficiente.</p>
            <a href="nueva_tarea.php" class="btn btn-success btn-lg">+ Nueva Tarea</a>
            <a href="exportar_csv.php" class="btn btn-secondary btn-lg">Exportar CSV</a>
            <a href="importar_csv.php" class="btn btn-info btn-lg">Importar CSV</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Lista de Tareas</h4>
                </div>
                <div class="card-body">
                    <?php if (count($tareas) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Fecha Límite</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tareas as $tarea): ?>
                                        <tr>
                                            <td><?= $tarea['id'] ?></td>
                                            <td><?= htmlspecialchars($tarea['titulo']) ?></td>
                                            <td><?= htmlspecialchars($tarea['descripcion']) ?></td>
                                            <td><?= htmlspecialchars($tarea['fecha_limite']) ?></td>
                                            <td>
                                                <a href="editar_tarea.php?id=<?= $tarea['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                                <a href="borrar_tarea.php?id=<?= $tarea['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">Borrar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center">No tienes tareas registradas. ¡Crea una nueva para empezar!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../layouts/footer.php';
?>