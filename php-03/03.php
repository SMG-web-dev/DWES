<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-03</title>
    <?php
    function createNews2()
    {
        $array = [
            "El Pais" => "https://www.elpais.com",
            "El Mundo" => "https://www.elmundo.es",
            "El Abc" => "https://www.abc.es/",
            "El As" => "https://as.com/",
            "El Marca" => "https://www.marca.com/"
        ];
        return $array;
    }

    function showNewsRand($array)
    {
        $start = random_int(0, 4);
        $keys = array_keys($array);
        for ($i = $start; $i < $start + 1 && $i < count($keys); $i++) {
            $key = $keys[$i];
            $link = "<a href='$array[$key]'>$key</a>";
        }

        echo "<li>$link</li><br>";
    }
    ?>
</head>

<body>
    <?= showNewsRand(createNews2()) ?>
</body>

</html>