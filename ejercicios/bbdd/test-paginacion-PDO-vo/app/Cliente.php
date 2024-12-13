<?php
class Cliente
{
    private $id;
    private $first_name;
    private $last_name;
    private $ip_address;
    private $email;
    private $telefono;
    private $gender;


    // Métodos mágicos
    public function __get($atributo)
    {
        if (property_exists($this, $atributo))
            return $this->$atributo;
    }
    public function __set($atributo, $valor)
    {
        if (property_exists($this, $atributo))
            $this->$atributo = $valor;
    }
}
