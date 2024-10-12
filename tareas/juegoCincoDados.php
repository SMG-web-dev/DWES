<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JuegoCincoDados</title>
    <style>
        body {
            background-color: gray;
        }

        table,
        td {
            border: 1px solid black;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
        }

        table {
            background-color: black;
        }

        td {
            background-color: lightgray;
            min-width: 4.5em;
        }

        .player1 {
            background-color: red;
            font-size: 2rem;
            color: white;
        }

        .player2 {
            background-color: blue;
            font-size: 2rem;
            color: white;
        }
    </style>
    <?php
    function dice()
    {
        return [
            "&#9856", // 1
            "&#9857", // 2
            "&#9858", // 3
            "&#9859", // 4
            "&#9860", // 5
            "&#9861"  // 6
        ];
    }

    function playerPick($dice)
    {
        $arr = [];
        for ($i = 0; $i < 5; $i++) {
            $arr[] = random_int(1, 6);
        }
        return $arr;
    }

    function drawDice($pick, $dice, $player)
    {
        $output = "";
        $class = $player === 0 ? 'player1' : 'player2';
        foreach ($pick as $value) {
            $output .= $dice[$value - 1] . " ";
        }
        return "<td class='$class'>$output</td>";
    }

    function drawPlayer($i)
    {
        return $i == 0 ? "<b>Jugador 1</b>" : "<b>Jugador 2</b>";
    }

    function calcPtos($pick)
    {
        sort($pick);
        array_shift($pick);  // Elimina el primer elemento
        array_pop($pick);    // Elimina el último elemento
    
        $ptos = 0;
        foreach ($pick as $value)
            $ptos += $value;
        return $ptos;
    }

    function calcWin($ptos1, $ptos2)
    {
        return ($ptos1 > $ptos2) ? "<b>Gana el Jugador 1</b>"
            : ($ptos1 < $ptos2 ? "<b>Gana el Jugador 2</b>"
                : "<b>Empate</b>");
    }

    function drawGame($dice)
    {
        $ptos = [0, 0];

        for ($i = 0; $i < 2; $i++) {
            $pick = playerPick($dice);
            $ptos[$i] = calcPtos($pick);

            echo "<tr>
                    <td>" . drawPlayer($i) . "</td>
                    " . drawDice($pick, $dice, $i) . "
                    <td><b>" . $ptos[$i] . "ptos.</b></td>
                  </tr>";
        }
        echo "<tr><td colspan='3' style='text-align:center;'>" . calcWin($ptos[0], $ptos[1]) . "</td></tr>";
    }

    function run()
    {
        $dice = dice();
        drawGame($dice);
    }
    ?>
</head>

<body>
    <table>
        <?= run() ?>
    </table>
</body>

</html>