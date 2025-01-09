<?php
// Archivo que contiene las acciones relacionadas con los clientes
include_once 'AccesoDatos.php';
include_once 'AccesoDAO.php';

// Función para borrar un cliente
function accionBorrar($id)
{
    $conexion = AccesoDatos::conectar();
    $stmt = $conexion->prepare("DELETE FROM clientes WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// Función para terminar la sesión
function accionTerminar()
{
    session_start();
    session_destroy();
}

// Función para mostrar los detalles de un cliente
function accionDetalles($id)
{
    $conexion = AccesoDatos::conectar();
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Incluir la plantilla de detalles
    include __DIR__ . '/layout/detalles.php';
}

// Función para modificar un cliente
// Función para dar de alta un nuevo cliente
function accionAlta()
{
    // Si no es una petición POST, mostrar el formulario
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        include "layout/nuevo.php";
        return;
    }

    // Procesar el formulario cuando se envía por POST
    try {
        // Validar y recoger datos del formulario
        $datos = [
            'nombre' => isset($_POST['first_name']) ? trim($_POST['first_name']) : '',
            'apellido' => isset($_POST['last_name']) ? trim($_POST['last_name']) : '',
            'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
            'genero' => isset($_POST['gender']) ? trim($_POST['gender']) : '',
            'telefono' => isset($_POST['telefono']) ? trim($_POST['telefono']) : '',
            'ip_address' => $_SERVER['REMOTE_ADDR']
        ];

        // Validar que los campos requeridos no estén vacíos
        foreach ($datos as $campo => $valor) {
            if (empty($valor) && $campo !== 'telefono') {
                throw new Exception("El campo $campo es obligatorio");
            }
        }

        // Validar formato de email
        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El formato del email no es válido");
        }

        // Obtener instancia del DAO y realizar la inserción
        $dao = AccesoDAO::getModelo();
        $dao->insertarCliente(
            $datos['nombre'],
            $datos['apellido'],
            $datos['email'],
            $datos['genero'],
            $datos['ip_address'],
            $datos['telefono']
        );

        // Redirigir con mensaje de éxito
        $_SESSION['mensaje'] = "Cliente añadido correctamente";
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        // Mantener los datos introducidos en caso de error
        $_SESSION['datos_form'] = $datos;
        header("Location: index.php?op=nuevo");
        exit();
    }
}

// Función para modificar un cliente existente
function accionModificar($id)
{
    $dao = AccesoDAO::getModelo();

    // Si no es una petición POST, mostrar el formulario con los datos actuales
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        try {
            $cliente = $dao->getClientePorId($id);
            if (!$cliente) {
                throw new Exception("Cliente no encontrado");
            }
            include "layout/modificar.php";
            return;
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header("Location: index.php");
            exit();
        }
    }

    // Procesar el formulario cuando se envía por POST
    try {
        // Validar y recoger datos del formulario
        $datos = [
            'id' => $id,
            'nombre' => isset($_POST['first_name']) ? trim($_POST['first_name']) : '',
            'apellido' => isset($_POST['last_name']) ? trim($_POST['last_name']) : '',
            'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
            'genero' => isset($_POST['gender']) ? trim($_POST['gender']) : '',
            'telefono' => isset($_POST['telefono']) ? trim($_POST['telefono']) : '',
            'ip_address' => $_SERVER['REMOTE_ADDR']
        ];

        // Validar que los campos requeridos no estén vacíos
        foreach ($datos as $campo => $valor) {
            if (empty($valor) && $campo !== 'telefono' && $campo !== 'ip_address') {
                throw new Exception("El campo $campo es obligatorio");
            }
        }

        // Validar formato de email
        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El formato del email no es válido");
        }

        // Realizar la actualización
        $dao->actualizarCliente(
            $datos['id'],
            $datos['nombre'],
            $datos['apellido'],
            $datos['email'],
            $datos['genero'],
            $datos['ip_address'],
            $datos['telefono']
        );

        // Redirigir con mensaje de éxito
        $_SESSION['mensaje'] = "Cliente modificado correctamente";
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        // Mantener los datos introducidos en caso de error
        $_SESSION['datos_form'] = $datos;
        header("Location: index.php?op=modificar&id=$id");
        exit();
    }
}
