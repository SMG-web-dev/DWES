<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../web/default.css">
    <title>Detalles del Cliente</title>
</head>
<body>
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-content">
            <div id="header">
                <h1>Detalles del Cliente</h1>
            </div>
            <div class="modal-body">
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
                <a class="button" href="index.php?orden=Modificar&id=<?= $cliente->id ?>">Modificar</a>
                <button class="button" onclick="closeModal()">Cerrar</button>
            </div>
        </div>
    </div>
    <script>
        function closeModal() {
            document.getElementById('modalOverlay').style.display = 'none';
        }
    </script>
</body>
</html> 