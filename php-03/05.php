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
        for ($i = 0; $i < 6; $i++) {
            $arr[$i] = random_int(1, 49);
        }
        return $arr;
    }
    function showBonoloto($array)
    {
        foreach ($array as $value) {
            if (count($array) == $array[$value])
                echo "<th>Complementario " . $value . "</th>";
            else
                echo "<th>" . $value . "</th>";
        }
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