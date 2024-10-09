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
        while (count($arr) < 6) {
            $num = random_int(1, 49);
            if (!in_array($num, $arr))
                $arr[] = (count($arr) == 5) ?
                    "Complementario: $num" : $num;
        }
        sort($arr);
        return $arr;
    }
    function showBonoloto($array)
    {
        foreach ($array as $value)
            echo "<th>" . $value . "</th>";
    }

    ?>
</head>

<body>
    <table>
        <tr>
            <?= showBonoloto(createBonoloto()) ?>
        </tr>
    </table>
</body>

</html>