<?php

// Crear la tabla asociativa $tmulti
$tmulti = array();

// Rellenar la tabla de multiplicar del 1 al 10
for ($i = 1; $i <= 10; $i++) {
    for ($j = 1; $j <= 10; $j++) {
        $tmulti[$i][$j] = $i * $j;
    }
}

// $tmulti ahora contiene la tabla de multiplicar del 1 al 10

echo "
<pre>";
var_dump($tmulti);
