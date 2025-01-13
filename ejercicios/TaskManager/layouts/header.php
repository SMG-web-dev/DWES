<?php
require_once '../includes/conexion.php';
verificar_sesion();

$sql = "SELECT * FROM tareas WHERE usuario_id = ? ORDER BY fecha_limite ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['usuario_id']]);
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../layouts/header.php';
?>

<div class="container py-5 animate__animated animate__fadeIn">
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="display-4 fw-bold mb-3">Mis Tareas</h1>
            <p class="lead text-muted mb-4">Administra tus tareas de manera fácil y eficiente.</p>
            <div class="d-flex gap-2 justify-content-center flex-wrap">
                <a href="nueva_tarea.php" class="btn btn-primary btn-lg animate__animated animate__fadeInUp">
                    <i class="bi bi-plus-circle me-2"></i>Nueva Tarea
                </a>
                <a href="exportar_csv.php" class="btn btn-outline-secondary btn-lg animate__animated animate__fadeInUp animate__delay-1s">
                    <i class="bi bi-download me-2"></i>Exportar CSV
                </a>
                <a href="importar_csv.php" class="btn btn-outline-primary btn-lg animate__animated animate__fadeInUp animate__delay-2s">
                    <i class="bi bi-upload me-2"></i>Importar CSV
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg animate__animated animate__fadeInUp animate__delay-3s">
                <div class="card-header bg-gradient">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">
                            <i class="bi bi-list-check me-2"></i>Lista de Tareas
                        </h4>
                        <span class="badge bg-primary rounded-pill">
                            <?= count($tareas) ?> tareas
                        </span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php if (count($tareas) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th class="px-4">#</th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th class="text-center">Fecha Límite</th>
                                        <th class="text-end px-4">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tareas as $tarea): ?>
                                        <tr class="transition-all hover:bg-light">
                                            <td class="px-4"><?= $tarea['id'] ?></td>
                                            <td class="fw-semibold"><?= htmlspecialchars($tarea['titulo']) ?></td>
                                            <td class="text-muted"><?= htmlspecialchars($tarea['descripcion']) ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-info rounded-pill">
                                                    <i class="bi bi-calendar-event me-1"></i>
                                                    <?= htmlspecialchars($tarea['fecha_limite']) ?>
                                                </span>
                                            </td>
                                            <td class="text-end px-4">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="editar_tarea.php?id=<?= $tarea['id'] ?>"
                                                        class="btn btn-outline-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="borrar_tarea.php?id=<?= $tarea['id'] ?>"
                                                        class="btn btn-outline-danger"
                                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?')">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted"></i>
                            <p class="lead mt-3 mb-0">No tienes tareas registradas.</p>
                            <p class="text-muted">¡Crea una nueva para empezar!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(to right, #f8f9fa, #ffffff);
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    .table td,
    .table th {
        padding: 1rem;
    }

    .btn-group .btn {
        padding: 0.5rem;
        line-height: 1;
    }

    .animate__animated {
        animation-duration: 0.8s;
    }
</style>

<?php include '../layouts/footer.php'; ?>