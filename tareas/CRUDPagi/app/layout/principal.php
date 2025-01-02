<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../web/default.css">
    <title>Lista de Clientes</title>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1>Lista de Clientes</h1>
        </div>
        <div>
            <?= $contenido; // Muestra los datos de los clientes ?>
        </div>
        <div class="pagination">
            <?php
            // Mostrar la paginación
            if ($primero == 0) {
                if ($primero < $ultimo) {
                    echo '<a class="button" href="?orden=Siguiente">Siguiente</a>';
                    echo '<a class="button" href="?orden=Ultimo">Último</a>';
                }
            } 
            else if ($primero == $ultimo) {
                echo '<a class="button" href="?orden=Primero">Primero</a>';
                echo '<a class="button" href="?orden=Anterior">Anterior</a>';
            } 
            else {
                echo '<a class="button" href="?orden=Primero">Primero</a>';
                echo '<a class="button" href="?orden=Anterior">Anterior</a>';
                echo '<a class="button" href="?orden=Siguiente">Siguiente</a>';
                echo '<a class="button" href="?orden=Ultimo">Último</a>';
            }
            ?>
        </div>
    </div>
</body>
</html>
