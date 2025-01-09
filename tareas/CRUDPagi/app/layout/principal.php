<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Lista de Clientes</title>
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>Lista de Clientes</h1>
        </div>
        <div>
            <?= $contenido; // Muestra los datos de los clientes 
            ?>
        </div>
        <div class="pagination">
            <?php
            // Mostrar la paginación
            echo '<div class="button-group"><a class="button" href="index.php?orden=Nuevo"><i class="fas fa-plus"></i></a>';
            if ($primero == 0) {
                if ($primero < $ultimo) {
                    echo '<a class="button" href="?orden=Siguiente"><i class="fas fa-chevron-right"></i></a>';
                    echo '<a class="button" href="?orden=Ultimo"><i class="fas fa-angle-double-right"></i></a>';
                }
            } else if ($primero == $ultimo) {
                echo '<a class="button" href="?orden=Primero"><i class="fas fa-angle-double-left"></i></a>';
                echo '<a class="button" href="?orden=Anterior"><i class="fas fa-chevron-left"></i></a>';
            } else {
                echo '<a class="button" href="?orden=Primero"><i class="fas fa-angle-double-left"></i></a>';
                echo '<a class="button" href="?orden=Anterior"><i class="fas fa-chevron-left"></i></a>';
                echo '<a class="button" href="?orden=Siguiente"><i class="fas fa-chevron-right"></i></a>';
                echo '<a class="button" href="?orden=Ultimo"><i class="fas fa-angle-double-right"></i></a>';
            }
            echo '</div>';
            ?>
        </div>
    </div>
</body>

</html>