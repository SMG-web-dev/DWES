<?php

class Bici
{
    private $id; // Identificador de la bicicleta (entero)
    private $coordx; // Coordenada X (entero)
    private $coordy; // Coordenada Y (entero)
    private $operativa; // Estado de la bicicleta (true operativa, false no disponible)

    public function __construct($id, $coordx = 0, $coordy = 0, $operativa = true)
    {
        $this->id = $id;
        $this->coordx = $coordx;
        $this->coordy = $coordy;
        $this->operativa = $operativa;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCoordX($coordx)
    {
        $this->coordx = $coordx;
    }

    public function getCoordX()
    {
        return $this->coordx;
    }

    public function setCoordY($coordy)
    {
        $this->coordy = $coordy;
    }

    public function getCoordY()
    {
        return $this->coordy;
    }

    public function setOperativa($operativa)
    {
        $this->operativa = $operativa;
    }

    public function isOperativa()
    {
        return $this->operativa;
    }

    public function __toString()
    {
        return "Bici {$this->id}: " .
            ($this->operativa ? "Operativa" : "No disponible");
    }

    // Método para calcular la distancia entre esta bicicleta y una posición (x, y)
    public function calcularDistancia($x, $y)
    {
        return sqrt(pow($this->coordx - $x, 2) +
            pow($this->coordy - $y, 2));
    }
}

class BiciElectrica extends Bici
{
    private $bateria; // Carga de la batería en tanto por ciento (entero)

    public function __construct($id, $coordx = 0, $coordy = 0, $operativa = true, $bateria = 100)
    {
        parent::__construct($id, $coordx, $coordy, $operativa);
        $this->bateria = $bateria;
    }

    public function setBateria($bateria)
    {
        // Aseguramos que esté entre 0 y 100
        $this->bateria = max(0, min(100, $bateria));
    }

    public function getBateria()
    {
        return $this->bateria;
    }

    public function toString()
    {
        return parent::__toString() . " - Batería: {$this->bateria}%";
    }
}
