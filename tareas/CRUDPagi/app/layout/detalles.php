<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Detalles del Cliente</title>
</head>

<body>
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <div id="header">
                <h1>Detalles del Cliente</h1>
            </div>
            <div class="modal-body">
                <?php if (isset($_SESSION['msg'])): ?>
                    <script>
                        showNotification('<?= htmlspecialchars($_SESSION['msg']) ?>', '<?= isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : 'success' ?>');
                    </script>
                    <?php
                    unset($_SESSION['msg']);
                    unset($_SESSION['msg_type']);
                    ?>
                <?php endif; ?>
                <ul class="detail-list">
                    <li><strong>ID:</strong> <?= $cliente->id ?></li>
                    <li><strong>Nombre:</strong> <?= $cliente->first_name ?></li>
                    <li><strong>Apellido:</strong> <?= $cliente->last_name ?></li>
                    <li><strong>Email:</strong> <?= $cliente->email ?></li>
                    <li><strong>Género:</strong> <?= $cliente->gender ?></li>
                    <li><strong>Teléfono:</strong> <?= $cliente->telefono ?></li>
                    <li><strong>IP Address:</strong> <?= $cliente->ip_address ?></li>
                </ul>
            </div>
            <div class="modal-footer">
                <a class="button" href="index.php?orden=Modificar&id=<?= $cliente->id ?>">
                    <i class="fas fa-edit"></i>
                </a>
                <button class="button" onclick="window.location='index.php'">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</body>

</html>