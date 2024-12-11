<?php
require_once 'BiciElectrica.php';

function cargarBicis()
{
    $bicicletas = [];
    $archivo = 'Bicis.csv';

    if (($gestor = fopen($archivo, "r")) !== FALSE) {
        while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
            if (count($datos) == 5) {
                $id = $datos[0];
                $coordx = $datos[1];
                $coordy = $datos[2];
                $bateria = $datos[3];
                $operativa = $datos[4] == '1';

                $bicicleta = new BiciElectrica($id, $coordx, $coordy, $operativa, $bateria);
                $bicicletas[] = $bicicleta;
            }
        }
        fclose($gestor);
    }

    return $bicicletas;
}

function mostrarTablaBicis($bicicletas)
{
    $html = "<table>";
    $html .= "<tr><th>ID</th><th>Coordenada X</th><th>Coordenada Y</th><th>Operativa</th><th>Batería</th></tr>";

    foreach ($bicicletas as $bici) {
        $html .= "<tr>";
        $html .= "<td>" . $bici->getId() . "</td>";
        $html .= "<td>" . $bici->getCoordX() . "</td>";
        $html .= "<td>" . $bici->getCoordY() . "</td>";
        $html .= "<td>" . ($bici->isOperativa() ? "Sí" : "No") . "</td>";
        $html .= "<td>" . $bici->getBateria() . "%</td>";
        $html .= "</tr>";
    }

    $html .= "</table>";
    return $html;
}

function biciMasCercana($bicicletas, $usuarioX, $usuarioY)
{
    $distanciaMinima = PHP_FLOAT_MAX;
    $biciMasCercana = null;

    foreach ($bicicletas as $bici) {
        if ($bici->isOperativa()) {
            $distancia = $bici->calcularDistancia($usuarioX, $usuarioY);
            if ($distancia < $distanciaMinima) {
                $distanciaMinima = $distancia;
                $biciMasCercana = $bici;
            }
        }
    }

    return $biciMasCercana;
}

$bicicletas = cargarBicis();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOSTRAR BICIS OPERATIVAS</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Listado de bicicletas</h1>
    <?= mostrarTablaBicis($bicicletas); ?>

    <?php
    if (!empty($_GET['coordx']) && !empty($_GET['coordy'])) {
        $biciRecomendada = biciMasCercana($bicicletas, $_GET['coordx'], $_GET['coordy']);
        if ($biciRecomendada) {
            echo "<h2>Bicicleta disponible más cercana:</h2>";
            echo "<p>" . $biciRecomendada->toString() . "</p>";
        } else {
            echo "<p>No se encontró ninguna bicicleta operativa cercana.</p>";
        }
        echo "<button onclick='window.location.href=\"" . $_SERVER['PHP_SELF'] . "\"'>Volver</button>";
    } else {
    ?>
        <h2>Indicar su ubicación:</h2>
        <form method="GET">
            <label for="coordx">Coordenada X:</label>
            <input type="number" id="coordx" name="coordx" required><br>
            <label for="coordy">Coordenada Y:</label>
            <input type="number" id="coordy" name="coordy" required><br>
            <input type="submit" value="Consultar">
        </form>
    <?php
    }
    ?>
</body>

</html>