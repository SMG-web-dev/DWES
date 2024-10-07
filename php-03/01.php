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
            array_push($arr, rand(1, 10));
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
        $max = 0;
        foreach ($array as $value)
            if ($value > $array[$value - 1])
                $max = $value;
        echo "<th>$max</th>";
    }
    function calcMin($array)
    {

    }
    function calcSame($array)
    {

    }
    ?>
</head>

<body>
    <table>
        <tr><?= drawArray($array) ?></tr>
        <tr><?= calcMax($array) ?></tr>
    </table>
</body>

</html>