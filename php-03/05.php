<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-05</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
            color: blueviolet;
        }
    </style>
    <?php
    function createBonoloto()
    {
        $arr = [];
        while (count($arr) < 5) {
            $num = random_int(1, 49);
            if (!in_array($num, $arr))
                $arr[] = $num;
        }
        sort($arr);
        return $arr;
    }
    function createComplementario()
    {
        $num = random_int(1, 49);
        return $num;
    }
    function showBonoloto($array, $num)
    {
        foreach ($array as $value)
            echo "<th>" . $value . "</th>";
        echo "<th>Complementario: $num</th>";
    }

    ?>
</head>

<body>
    <table>
        <tr>
            <?= showBonoloto(createBonoloto(), createComplementario()) ?>
        </tr>
    </table>
</body>

</html>