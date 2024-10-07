<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-01</title>
    <style>
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <?php

    function createArray()
    {
        $arr = [];
        for ($i = 0; $i < 20; $i++)
            array_push($arr, rand(1, 15));
        return $arr;
    }
    $array = createArray();

    function drawArray($array)
    {
        foreach ($array as $value)
            echo "<th>$value</th>";
    }

    function calcMax($array)
    {
        echo "<h3>Valor que más grande: " . max($array) . "</h3>";
    }
    function calcMin($array)
    {
        echo "<h3>Valor que más pequeño: " . min($array) . "</h3>";
    }
    function calcSame($array)
    {
        $same = 0;
        foreach ($array as $value)
            for ($i = 0; $i < count($array); $i++)
                if ($array[$i] == $value)
                    $same++;

        echo "<h3>Valor que más se repite: $same</h3>";
    }
    ?>
</head>

<body>
    <table>
        <tr><?= calcMax($array) ?></tr>
        <tr><?= calcMin($array) ?></tr>
        <tr><?= calcSame($array) ?></tr>
        <tr><?= drawArray($array) ?></tr>
    </table>
</body>

</html>