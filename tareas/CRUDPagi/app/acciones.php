<?php
// Archivo que contiene las acciones relacionadas con los clientes
include_once 'AccesoDatos.php';
include_once 'AccesoDAO.php';

// Función para borrar un cliente
function accionBorrar($id) {
    $conexion = AccesoDatos::conectar();
    $stmt = $conexion->prepare("DELETE FROM clientes WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// Función para terminar la sesión
function accionTerminar() {
    session_start();
    session_destroy();
}

// Función para dar de alta un nuevo cliente
function accionAlta($nombre, $email) {
    $conexion = AccesoDatos::conectar();
    $stmt = $conexion->prepare("INSERT INTO clientes (nombre, email) VALUES (:nombre, :email)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

// Función para mostrar los detalles de un cliente
function accionDetalles($id) {
    $conexion = AccesoDatos::conectar();
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Incluir la plantilla de detalles
    include __DIR__ . '/layout/detalles.php';
}

// Función para modificar un cliente
function accionModificar($id) {
    $conexion = AccesoDatos::conectar();
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Verificar si se recibió un formulario de modificación
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);

        // Validar los datos
        if ($nombre && $apellido && $email && $genero) {
            // Usar la función de AccesoDAO para actualizar el cliente
            $dbh = AccesoDAO::getModelo();
            try {
                $dbh->actualizarCliente($id, $nombre, $apellido, $email, $genero, '', $telefono); // Pasar IP como vacío si no se tiene
                $_SESSION['message'] = "Cliente actualizado exitosamente."; // Mensaje de éxito
                header("Location: index.php"); // Redirigir a la lista de clientes
                exit();
            } catch (Exception $e) {
                $_SESSION['error'] = "Error al actualizar el cliente: " . $e->getMessage(); // Mensaje de error
            }
        } else {
            $_SESSION['error'] = "Por favor, complete todos los campos.";
        }
    }

    // Incluir la plantilla de modificación
    include 'layout/modificar.php';
}

// Función para crear un nuevo cliente
function accionCrear() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);

        // Validar los datos
        if ($nombre && $apellido && $email && $genero && $telefono) {
            // Usar la función de AccesoDAO para insertar el cliente
            $dbh = AccesoDAO::getModelo();
            try {
                $dbh->insertarCliente($nombre, $apellido, $email, $genero, '', $telefono); // Pasar IP como vacío si no se tiene
                $_SESSION['message'] = "Cliente agregado exitosamente."; // Mensaje de éxito
            } catch (Exception $e) {
                $_SESSION['error'] = "Error al agregar el cliente: " . $e->getMessage(); // Mensaje de error
            }

            // Redirigir a la lista de clientes
            header("Location: index.php");
            exit();
        } else {
            // Manejar error de validación
            $_SESSION['error'] = "Por favor, complete todos los campos.";
        }
    }

    // Mostrar el formulario para crear un nuevo cliente
    include 'layout/nuevo.php';
}


