<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3">
    <title>Ejercicio-07</title>

    <?php
    $red = random_int(0, 255);
    $green = random_int(0, 255);
    $blue = random_int(0, 255);
    $resu = "$red, $green, $blue";
    $factor = 2.5;
    ?>

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: grey;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            text-align: center;
            vertical-align: middle;
        }

        div {
            padding: 30px;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            letter-spacing: 1px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .bar {
            height: 30px;
            margin: 5px 0;
            display: inline-block;
        }

        .bar-container {
            justify-content: center;
        }

        .R {
            background-color: rgb(<?php echo $red . ', 0, 0 ' ?>);
            color:
                <?php
                if ($red < 100)
                    echo "white";
                else
                    echo "black";
                ?>
            ;
        }

        .G {
            background-color: rgb(<?php echo '0, ' . $green . ', 0 ' ?>);
            color:
                <?php
                if ($green < 90)
                    echo "white";
                else
                    echo "black";
                ?>
            ;
        }

        .B {
            background-color: rgb(<?php echo '0, 0,' . $blue ?>);
            color:
                <?php
                if ($blue < 140)
                    echo "white";
                else
                    echo "black";
                ?>
            ;
        }

        .RGB {
            background-color: rgb(<?php echo $red . ',' . $green . ',' . $blue; ?>);
            color:
                <?php
                if (($red + $blue + $red) < 125)
                    echo "white";
                else
                    echo "black";
                ?>
            ;
            width:
                <?php echo (($red + $green + $blue) / 3) * $factor; ?>
                px;
        }
    </style>
</head>

<body>
    <?php
    echo "<table>";
    echo "<tr><td><div class='bar R' style='width:" . ($red / $factor) . "pc;'>Rojo ($red)</div></td></tr>";
    echo "<tr><td><div class='bar G' style='width:" . ($green / $factor) . "pc;'>Verde ($green)</div></td></tr>";
    echo "<tr><td><div class='bar B' style='width:" . ($blue / $factor) . "pc;'>Azul ($blue)</div></td></tr>";
    echo "<tr><td><div class='bar RGB' style='width:" . (($red + $green + $blue) / 3 / $factor) . "pc;'>RGB ($resu)</div></td></tr>";
    echo "</table>";
    ?>
</body>

</html>