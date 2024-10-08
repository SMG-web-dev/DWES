<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-02</title>
    <?php
    function createNews()
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

    function showNews($array)
    {
        foreach ($array as $key => $value) {
            $link = "<a href='$value'>$key</a>";
            echo "<li>$link</li><br>";
        }
    }
    ?>
</head>

<body>
    <?= showNews(createNews()) ?>
</body>

</html>