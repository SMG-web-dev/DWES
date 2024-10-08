<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-04</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
        }

        img {
            height: 5rem;
        }
    </style>
    <?php
    function createArraySports()
    {
        return [
            "Badminton" => "badminton.png",
            "Breakdance" => "breakdance.png",
            "Equitación" => "equitacion.png",
            "Natación" => "natacion.png",
            "Tenis" => "tenis.png"
        ];
    }
    function showSports($array)
    {
        foreach ($array as $key => $value) {
            echo "<tr>
            <td>$key</td>
            <td><img src='img/$value'</td>
            </tr>";
        }



    }
    ?>
</head>

<body>
    <table>
        <tr>
            <th>Deporte</th>
            <th>Logo</th>
        </tr>
        <?= showSports(createArraySports()) ?>
    </table>
</body>

</html>