<?php
// Clase para manejar la conexión a la base de datos
class AccesoDatos
{
    private static $conexion = null;

    // Método para establecer la conexión a la base de datos
    public static function conectar()
    {
        if (self::$conexion === null) {
            self::$conexion = new PDO('mysql:host=localhost;dbname=Clientes', 'root', '');
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conexion;
    }

    // Método para cerrar la conexión a la base de datos
    public static function closeModelo()
    {
        self::$conexion = null;
    }
}
