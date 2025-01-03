<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web/default.css">
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
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
                <?php endif; ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                <?php endif; ?>
                <ul class="detail-list">
                    <li><strong>ID:</strong> <?= $cliente['id'] ?></li>
                    <li><strong>Nombre:</strong> <?= $cliente['first_name'] ?></li>
                    <li><strong>Apellido:</strong> <?= $cliente['last_name'] ?></li>
                    <li><strong>Email:</strong> <?= $cliente['email'] ?></li>
                    <li><strong>Género:</strong> <?= $cliente['gender'] ?></li>
                    <li><strong>Teléfono:</strong> <?= $cliente['telefono'] ?></li>
                    <li><strong>IP Address:</strong> <?= $cliente['ip_address'] ?></li>
                </ul>
            </div>
            <div class="modal-footer">
                <a class="button" href="index.php?orden=Modificar&id=<?= $cliente['id'] ?>">
                    <i class="fas fa-edit"></i> 
                </a>
                <button class="button" onclick="closeModal()">
                    <i class="fas fa-times"></i> 
                </button>
            </div>
        </div>
    </div>
    <script>
        function closeModal() {
            const modal = document.getElementById('modalOverlay');
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300); // Espera a que la animación de desvanecimiento termine
        }
    </script>
</body>
</html> 