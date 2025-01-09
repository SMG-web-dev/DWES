<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Modificar Cliente</title>
</head>
<body>
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <div id="header">
                <h1>Modificar Cliente</h1>
            </div>
            <form method="POST" action="index.php?orden=Modificar&id=<?= $cliente['id'] ?>">
                <div class="modal-body">
                    <?php if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-success"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" value="<?= $cliente['first_name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" value="<?= $cliente['last_name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?= $cliente['email'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Género:</label>
                        <select name="genero" required>
                            <option value="masculino" <?= $cliente['gender'] == 'masculino' ? 'selected' : '' ?>>Masculino</option>
                            <option value="femenino" <?= $cliente['gender'] == 'femenino' ? 'selected' : '' ?>>Femenino</option>
                            <option value="otro" <?= $cliente['gender'] == 'otro' ? 'selected' : '' ?>>Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" name="telefono" value="<?= $cliente['telefono'] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="button">
                        <i class="fas fa-save"></i>
                    </button>
                    <button type="button" class="button" onclick="closeModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </form>
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