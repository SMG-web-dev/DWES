<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-02</title>
</head>

<body>
    <?php
    $num = random_int(1, 9);
    echo "Número generado: $num <br>";
    for ($i = 1; $i <= $num; $i++) {
        for ($j = $i; $j <= $num; $j++) {
            echo "$j";
        }
    }
    ?>
</body>

</html>