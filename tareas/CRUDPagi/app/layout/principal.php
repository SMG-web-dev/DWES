<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="web/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="web/js/funciones.js" defer></script>
    <title>Lista de Clientes</title>
</head>

<body>
    <div id="container">
        <div id="notification-container"></div>
        <div id="header">
            <h1>Lista de Clientes</h1>
            <div class="filter-controls">
                <div class="filter-group">
                    <i class="fas fa-search filter-icon"></i>
                    <input type="text" id="searchInput" placeholder="Buscar cliente...">
                </div>
                <div class="filter-group">
                    <i class="fas fa-venus-mars filter-icon"></i>
                    <select id="genderFilter">
                        <option value="">Todos los géneros</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="filter-group">
                    <i class="fas fa-sort-alpha-up filter-icon"></i>
                    <select id="sortFilter">
                        <option value="">Ordenar por...</option>
                        <option value="nombreAsc">Nombre (A-Z)</option>
                        <option value="nombreDesc">Nombre (Z-A)</option>
                    </select>
                </div>
            </div>
        </div>
        <div>
            <?php echo $contenido; ?>
        </div>

        <div class="pagination">
            <?php
            // Mostrar la paginación
            echo '<div class="button-group">';
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
        <div class="button-group">
            <a class="button button-add" href="index.php?orden=Nuevo"><i class="fas fa-plus"></i>&nbsp; Agregar Cliente</a>
            <a class="button button-logout" href="index.php?orden=Terminar"><i class="fas fa-sign-out-alt"></i>&nbsp; Cerrar Sesión</a>
        </div>
    </div>
</body>

</html>