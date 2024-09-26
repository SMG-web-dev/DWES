<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-06</title>
    <style>
        body {
            background-color: lightslategray;
            display: flex;
            flex-direction: column;
            min-height: 40em;
            margin: 15px;
        }

        header {
            height: 6em;
            background-color: blue;
            display: flex;
            justify-content: center;
            /* Centra horizontalmente */
            align-items: center;
            /* Centra verticalmente */
            width: 100%;
            /* Asegura que el header ocupe todo el ancho */
        }

        div {
            height: 45em;
            border: 1px solid black;
            margin: 0 auto;
            width: 25%;
            flex: 1;
        }

        h2 {
            color: white;
            text-align: center;
            font-family: 'Liberation Sans', sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 8em;
            margin-left: 20px;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
        }

        .caja {
            background-color: white;
            width: 100%;
            flex: 1;
            border: ;
        }

        .resu {
            text-align: right;
        }
    </style>
</head>

<body>
    <?php
    $num = random_int(1, 10);
    $caja = 'caja';
    $resu = 'resu';
    echo "
    <div>
        <header>
            <h2>TABLA DE MULTIPLICAR</h2>
        </header><box>
        <div class='caja'>
            <table>
            <tr><th>Tabla del $num</th><th></th></tr>
            ";
    for ($i = 1; $i <= 10; $i++) {
        echo "<tr><td>$num x $i =</td><td class='resu'>" . $num * $i . "</td></tr>";
    }
    echo "</table></div></box></div>";
    ?>
</body>

</html>