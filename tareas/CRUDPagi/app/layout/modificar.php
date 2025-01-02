<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../web/default.css">
    <title>Modificar Cliente</title>
</head>
<body>
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <div id="header">
                <h1>Modificar Cliente</h1>
            </div>
            <form method="POST" action="index.php?orden=Modificar&id=<?= $cliente->id ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" value="<?= $cliente->first_name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" value="<?= $cliente->last_name ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?= $cliente->email ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Género:</label>
                        <input type="text" name="genero" value="<?= $cliente->gender ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" value="<?= $cliente->telefono ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="button">Guardar Cambios</button>
                    <button class="button" onclick="closeModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
        }
    </script>
</body>
</html> 