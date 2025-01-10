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
            <form method="POST" action="index.php">
                <input type="hidden" name="orden" value="Modificar">
                <input type="hidden" name="id" value="<?= $cliente->id ?>">
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
                    <div class="form-group">
                        <label for="first_name">Nombre:</label>
                        <input type="text" name="first_name" value="<?= $cliente->first_name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Apellido:</label>
                        <input type="text" name="last_name" value="<?= $cliente->last_name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?= $cliente->email ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Género:</label>
                        <select name="gender" required>
                            <option value="masculino" <?= $cliente->gender == 'masculino' ? 'selected' : '' ?>>Masculino</option>
                            <option value="femenino" <?= $cliente->gender == 'femenino' ? 'selected' : '' ?>>Femenino</option>
                            <option value="otro" <?= $cliente->gender == 'otro' ? 'selected' : '' ?>>Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" name="telefono" value="<?= $cliente->telefono ?>">
                    </div>
                    <div class="form-group">
                        <label for="ip_address">IP Address:</label>
                        <input type="text" name="ip_address" value="<?= $cliente->ip_address ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="button">
                        <i class="fas fa-save"></i>
                    </button>
                    <button type="button" class="button" onclick="window.location='index.php'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>