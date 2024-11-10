<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMG | &#x1F91C;&#x1F91A;&#x1F596;</title>
    <style>
        span {
            width: 120px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .resu {
            font-size: 20px;
            text-align: center;
            column-span: 2;
            margin-left: 3.5%;
        }

        .emote {
            font-size: 90px;
            text-align: center;
        }
    </style>
    <?php
    define('PIEDRA1', "&#x1F91C;");
    define('PIEDRA2', "&#x1F91B;");
    define('TIJERAS', "&#x1F596;");
    define('PAPEL', "&#x1F91A;");
    $P1 = random_int(1, 3);
    $P2 = random_int(1, 3);
    function showPicksP1($p1)
    {
        if ($p1 == 1)
            $resu1 = PIEDRA1;
        elseif ($p1 == 2)
            $resu1 = PAPEL;
        elseif ($p1 == 3)
            $resu1 = TIJERAS;
        return "<span class='emote'>$resu1</span>";
    }
    function showPicksP2($p2)
    {
        if ($p2 == 1)
            $resu2 = PIEDRA2;
        elseif ($p2 == 2)
            $resu2 = PAPEL;
        elseif ($p2 == 3)
            $resu2 = TIJERAS;
        return "<span class='emote'>$resu2</span>";
    }
    function calcWinner($p1, $p2)
    {
        if ($p1 == $p2) {
            $FIN = "<span class='resu'><b>¡Empate!</b></span>";
            return $FIN;
        }
        return $FIN = (($p1 == 1 && $p2 == 3) ||
            ($p1 == 3 && $p2 == 2) ||
            ($p1 == 2 && $p2 == 1)) ?
            "<span class='resu'><b>Ha ganado el jugador 1</b></span>" :
            "<span class='resu''><b>Ha ganado el jugador 2</b></span>";
    }
    $Pick1 = showPicksP1($P1);
    $Pick2 = showPicksP2($P2);
    $FIN = calcWinner($P1, $P2);
    ?>
</head>


<body>
    <h1>¡Piedra, papel, tijera!</h1>
    <p>Actualice la página para mostrar otra partida.</p>
    <table>
        <tr>
            <th><b>Jugador 1</b></th>
            <th><b>Jugador 2</b></th>
        </tr>
        <tr>
            <td><?= $Pick1 ?></td>
            <td><?= $Pick2 ?></td>
        </tr>
    </table>
    <?= $FIN ?>
</body>

</html>