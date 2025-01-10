<?php

function accionBorrar($id)
{
    $db = AccesoDAO::getModelo();
    try {
        // Verificar si el cliente existe
        $cliente = $db->getClientePorId($id);
        if (!$cliente) {
            $_SESSION['msg'] = "Cliente no existe o ya ha sido eliminado.";
            return;
        }

        // Eliminar el cliente
        $db->borrarCliente($id);
        $_SESSION['msg'] = "Cliente eliminado correctamente.";
    } catch (Exception $e) {
        $_SESSION['msg'] = "Error al eliminar el cliente: " . $e->getMessage();
    }
}

function accionTerminar()
{
    AccesoDAO::closeModelo();
    session_destroy();
    $_SESSION['msg'] = "Sesión finalizada correctamente";
}

function accionDetalles($id)
{
    $db = AccesoDAO::getModelo();
    try {
        $cliente = $db->getClientePorId($id);
        if (!$cliente) {
            $_SESSION['msg'] = "Cliente no encontrado.";
            header("Location: index.php");
            return;
        }
        include_once "app/layout/detalles.php";
    } catch (Exception $e) {
        $_SESSION['msg'] = "Error al obtener los detalles del cliente: " . $e->getMessage();
        header("Location: index.php");
    }
}

function accionModificar($id)
{
    $db = AccesoDAO::getModelo();
    try {
        $cliente = $db->getClientePorId($id);
        if (!$cliente) {
            $_SESSION['msg'] = "Cliente no encontrado.";
            header("Location: index.php");
            return;
        }
        include_once "app/layout/modificar.php";
    } catch (Exception $e) {
        $_SESSION['msg'] = "Error al obtener los datos del cliente: " . $e->getMessage();
        header("Location: index.php");
    }
}

function accionPostModificar()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = AccesoDAO::getModelo();
        try {
            // Sanitizar los datos de entrada
            limpiarArrayEntrada($_POST);

            // Verificar campos obligatorios
            if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email'])) {
                $_SESSION['msg'] = "Los campos nombre, apellido y email son obligatorios.";
                header("Location: index.php");
                return;
            }

            // Obtener el ID del cliente y validarlo
            $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
            if (!$id) {
                $_SESSION['msg'] = "ID de cliente no válido.";
                header("Location: index.php");
                return;
            }

            // Actualizar cliente
            $db->actualizarCliente(
                $id,
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email'],
                $_POST['gender'],
                $_POST['ip_address'],
                $_POST['telefono']
            );

            $_SESSION['msg'] = "Cliente actualizado correctamente.";
        } catch (Exception $e) {
            $_SESSION['msg'] = "Error al modificar el cliente: " . $e->getMessage();
        }
    }
    header("Location: index.php");
}

function accionAlta()
{
    include_once "app/layout/nuevo.php";
}

function accionPostAlta()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = AccesoDAO::getModelo();
        try {
            // Sanitizar los datos de entrada
            limpiarArrayEntrada($_POST);

            // Verificar campos obligatorios
            if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email'])) {
                $_SESSION['msg'] = "Los campos nombre, apellido y email son obligatorios.";
                header("Location: index.php?orden=Nuevo");
                return;
            }

            // Insertar nuevo cliente
            $db->insertarCliente(
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email'],
                $_POST['gender'],
                $_POST['ip_address'],
                $_POST['telefono']
            );

            $_SESSION['msg'] = "Nuevo cliente añadido correctamente.";
        } catch (Exception $e) {
            $_SESSION['msg'] = "Error al añadir el cliente: " . $e->getMessage();
            header("Location: index.php?orden=Nuevo");
            return;
        }
    }
    header("Location: index.php");
}
