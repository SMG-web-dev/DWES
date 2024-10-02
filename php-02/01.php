<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-01</title>
</head>

<body>
    <?php
    function elMayor($a, $b, $c): int
    {
        if ($a > $b) {
            $c = $a;
        } else if ($a < $b) {
            $c = $b;
        } else
            $c = 0;
        return $c;
    }
    echo elMayor(10, 2, 3);
    ?>
</body>

</html>