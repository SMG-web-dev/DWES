<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-02</title>
    <style>
        .rojo {
            color: red;
        }

        .azul {
            color: blue;
        }
    </style>
</head>

<body>
    <?php
    $num = random_int(1, 9);
    echo "Número generado: $num <br>";
    for ($i = 1; $i <= $num; $i++) {
        $clase = ($i % 2 == 0) ? 'azul' : 'rojo';
        echo "<span class='$clase'>";
        for ($j = 1; $j <= $i; $j++) {
            echo "$i";
        }
        echo "</span><br>";
    }
    ?>
</body>

</html>