<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-03</title>
</head>

<body>
    <?php
    $num = random_int(1, 9);
    echo "Número generado: $num <br><br>";
    echo "<code>";
    for ($i = 1; $i <= $num; $i++) {
        echo str_repeat("\u{00A0}", $num - $i);
        echo str_repeat("*", 2 * $i - 1);
        echo "<br>";
    }
    echo "</code>";

    ?>
</body>

</html>