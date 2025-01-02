<?php
include_once "config.php";
require_once "Cliente.php";

/**
 * Clase AccesoDAO
 * 
 * Clase que se encarga de acceder a la base de datos y obtener los datos de los clientes
 * 
 */

class AccesoDAO {

    private static $modelo = null;
    private $dbh = null;
    private $stmt_clientes = null;
    private $stmt_numclientes = null;
    
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDAO();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
            echo "Conexión exitosa a la base de datos."; // Mensaje de prueba
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo las consultas de golpe y no las emulo.
        $this->dbh->setAttribute( PDO::ATTR_EMULATE_PREPARES, FALSE );
        try {
        $this->stmt_clientes  = $this->dbh->prepare("select * from Clientes limit :primero ,:cuantos");
        $this->stmt_numclientes  = $this->dbh->prepare("SELECT count(*) FROM Clientes ");
        } catch ( PDOException $e){
            echo " Error al crear la sentencias ".$e->getMessage();
            exit();
        }
    
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;   
            $obj->stmt_clientes = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo la lista de Clientes
    public function getClientes (int $primero, int $cuantos):array {
        $tuser = [];
        $this->stmt_clientes->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        $this->stmt_clientes->bindParam(":primero",$primero);
        $this->stmt_clientes->bindParam(":cuantos",$cuantos);
        if ( $this->stmt_clientes->execute() ){
            while ( $user = $this->stmt_clientes->fetch()){
               $tuser[]= $user;
            }
        }
        return $tuser;
    }

    public function totalClientes ():int{
        $this->stmt_numclientes->execute();
        $valor = $this->stmt_numclientes->fetch();
        return $valor[0];
    }
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }

    public function insertarCliente($nombre, $apellido, $email, $genero, $ip_address, $telefono) {
        try {
            $stmt = $this->dbh->prepare("INSERT INTO Clientes (first_name, last_name, email, gender, ip_address, telefono) VALUES (:nombre, :apellido, :email, :genero, :ip_address, :telefono)");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':ip_address', $ip_address);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->execute();
        } catch (PDOException $e) {
            // Manejar el error (registrar, mostrar mensaje, etc.)
            throw new Exception("Error al insertar cliente: " . $e->getMessage());
        }
    }

    public function getClientePorId($id) {
        $stmt = $this->dbh->prepare("SELECT * FROM Clientes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject('Cliente');
    }

    public function actualizarCliente($id, $nombre, $apellido, $email, $genero, $ip_address, $telefono) {
        $stmt = $this->dbh->prepare("UPDATE Clientes SET first_name = :nombre, last_name = :apellido, email = :email, gender = :genero, ip_address = :ip_address, telefono = :telefono WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':ip_address', $ip_address);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->execute();
    }

    public function borrarCliente($id) {
        $stmt = $this->dbh->prepare("DELETE FROM Clientes WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function getAllClientes(): array {
        $stmt = $this->dbh->prepare("SELECT * FROM Clientes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Cliente');
    }
}

