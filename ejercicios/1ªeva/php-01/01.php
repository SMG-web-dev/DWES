<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio-01</title>
</head>

<body>
    <?php
    $num1 = random_int(1, 10);
    $num2 = random_int(1, 10);
    echo "$num1+$num2 = " . $num1 + $num2 . "<br>";
    echo "$num1-$num2 = " . $num1 - $num2 . "<br>";
    echo "$num1*$num2 = " . $num1 * $num2 . "<br>";
    echo "$num1/$num2 = " . $num1 / $num2 . "<br>";
    echo "$num1%$num2 = " . $num1 % $num2 . "<br>";
    echo "$num1**$num2 = " . $num1 ** $num2 . "<br>";
    ?>
</body>

</html>
