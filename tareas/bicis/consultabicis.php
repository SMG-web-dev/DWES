<?php
function cargarBicisCSV() {}
function mostrarTablaBicis() {}
function biciMasCercana($bicicletas, $usuarioX, $usuarioY)
{
    $distanciaMinima = PHP_FLOAT_MAX;
    $biciMasCercana = null;

    foreach ($bicicletas as $bici) {
        if ($bici->isOperativa()) {
            $distancia = $bici->calcularDistancia($usuarioX, $usuarioY);
            if ($distancia < $distanciaMinima) {
                $distanciaMinima = $distancia;
                $biciMasCercana = $bici;
            }
        }
    }

    return $biciMasCercana;
}
