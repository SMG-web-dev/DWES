<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-05</title>
    <style>
        table {
            border-collapse: collapse;
            width: 14em;
        }

        th,
        td {
            border: 1px solid black;
            padding: 1px;
            font-family: 'Liberation Sans', sans-serif;
        }

        th {
            color: blue;
            background-color: grey;
        }

        .op {
            text-align: left;
        }

        .resu {
            text-align: right;
        }

        .gris {
            background-color: lightgrey;
        }
    </style>
</head>

<body>
    <?php
    $op = 'op';
    $resu = 'resu';
    $gris = 'gris';
    $num1 = random_int(1, 10);
    $num2 = random_int(1, 10);
    echo "<table> 
    <tr>
        <th class='op'>Operación</th>
        <th class='resu'>Resultado</th>
    </tr>
    <tr>
        <td>$num1+$num2</td>
        <td class='resu'>" . $num1 + $num2 . "</td>
    </tr>
    <tr class='gris'>
        <td>$num1-$num2</td>
        <td class='resu'>" . $num1 - $num2 . "</td>
    </tr>
    <tr>
        <td>$num1*$num2</td>
        <td class='resu'>" . $num1 * $num2 . "</td>
    </tr>
    <tr class='gris'>
        <td>$num1/$num2</td>
        <td class='resu'>" . number_format($num1 / $num2, 2) . "</td>
    </tr>
    <tr>
        <td>$num1%$num2</td>
        <td class='resu'>" . $num1 % $num2 . "</td>
    </tr>
    <tr class='gris'>
        <td>$num1^$num2</td>
        <td class='resu'>" . $num1 ** $num2 . "</td>
    </tr>
    </table>";
    ?>
</body>

</html>