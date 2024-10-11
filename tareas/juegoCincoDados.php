<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuegoCincoDados</title>
    <style>
        <
    </style>
    <?php
    function dice()
    {
        $dice = [
            "&#9856",
            "&#9857",
            "&#9858",
            "&#9859",
            "&#9860",
            "&#9861",
        ];
        return $dice;
    }
    function playerPick($dice)
    {

        for ($i = 0; $i < 5; $i++) {
            $arr[] = $dice[random_int(0, 5)];

        }
        return $arr;
    }

    function drawArray($array)
    {
        foreach ($array as $valor)
            echo $valor;
    }

    function calcWin($arr)
    {
    }
    function drawPick($arr)
    {
        for ($i = 0; $i < 2; $i++) {
            if ($i == 0) {
                echo "
                <tr>
                    <td>Jugador 1</td>
                    <td>" . drawArray($arr) . "</td>
                </tr>
                ";
            } else {
                echo "
                <tr>
                    <td>Jugador 2</td>
                    <td>" . drawArray($arr) . "</td>
                </tr>
                ";
            }
        }
    }
    function run()
    {
        drawArray(playerPick(dice()));
        echo "<br>";
        drawArray(playerPick(dice()));
    }
    ?>
</head>

<body>
    <table>
        <?= run() ?>
    </table>
</body>


</html>