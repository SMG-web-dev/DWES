<?php

class Reloj
{
    private $segundos;
    private $formato24;

    public function __construct(int $hora, int $minutos, int $segundos)
    {
        $this->segundos = $segundos + $hora * 360 + $minutos * 60;
    }

    // Mostrar la hora: genera un String con el  formado de hora  22:30:23
    // o 10:30:23 pm si el atributos Formato24 es falso

    public function mostrar()
    {
        $hora = $this->segundos / 360;
        $minu = $this->segundos / 60;
        $secs = $this->segundos % 360;
        return $hora . ":" . $minu . ":" . $secs;
    }

    // Cambiar formato24, recibe un valor true si quiero formato de
    // 24 o falso si quiero de 12
    public function  cambiarFormato24(bool $formato24)
    {
        if ($formato24) {
        } else {
        }
    }

    // Incrementa en un segundo el valor de reloj
    public function tictac()
    {
        $this->segundos++;
    }

    // Comparar Hora, recibe como parámetro otro objeto Reloj
    // y me devuelve el número de segundos que tienen de diferencia

    public function comparar(Reloj $otroreloj)
    {
        ($this->segundos > $otroreloj->segundos) ?
            $diff = $this->segundos - $otroreloj->segundos :
            $diff = $otroreloj->segundos - $this->segundos;
        return $diff;
    }
}
