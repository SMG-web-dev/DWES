<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-04</title>
</head>

<body>
    <?php
    $ini = microtime(true);
    $contador = 0;
    $seguidos = 0;
    while ($seguidos < 3) {
        $num = random_int(1, 10);
        $contador++;
        if ($num == 6)
            $seguidos++;
        else
            $seguidos = 0;
    }
    $fin = microtime(true);
    $tiempo = $fin - $ini;
    echo "Han salido tres 6 seguidos tras generar $contador números en " .
        number_format($tiempo, 6) . " milisegundos";
    ?>
</body>

</html>