<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include_once 'app/AccesoDatos.php';
include_once 'app/funciones.php';
include_once 'app/acciones.php';
require_once "app/Cliente.php";
require_once  "app/AccesoDAO.php";

define('FPAG', 10);

// Div con contenido
$contenido = "";

// Check for msg_type in query parameters and set it in session
if (isset($_GET['msg_type'])) {
    $_SESSION['msg_type'] = $_GET['msg_type'];
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['orden']) && in_array($_GET['orden'], ['Nuevo', 'Borrar', 'Modificar', 'Detalles', 'Terminar', 'Primero', 'Siguiente', 'Anterior', 'Ultimo'])) {
        switch ($_GET['orden']) {
            case "Nuevo":
                accionAlta();
                break;
            case "Borrar":
                accionBorrar(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
                break;
            case "Modificar":
                accionModificar(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
                break;
            case "Detalles":
                accionDetalles(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT));
                break;
            case "Terminar":
                accionTerminar();
                break;
        }
    }
} else {
    if (isset($_POST['orden']) && in_array($_POST['orden'], ['Nuevo', 'Modificar'])) {
        limpiarArrayEntrada($_POST); // Evito la posible inyección de código
        switch ($_POST['orden']) {
            case "Nuevo":
                accionPostAlta(); // Asegúrate de que esta función esté definida
                break;
            case "Modificar":
                accionPostModificar(); // Asegúrate de que esta función esté definida
                break;
        }
    }
}

// Lógica de paginación (igual que antes)
if (!isset($_SESSION['posini'])) {
    $_SESSION['posini'] = 0;
}

$dbh = AccesoDAO::getModelo();

try {
    $numclientes = $dbh->totalClientes();
} catch (Exception $e) {
    $numclientes = 0;
}

$ultimo = max(0, $numclientes - FPAG);
$primero = $_SESSION['posini'];

if (isset($_GET['orden'])) {
    switch ($_GET['orden']) {
        case "Primero":
            $primero = 0;
            break;
        case "Siguiente":
            $primero += FPAG;
            if ($primero > $ultimo) {
                $primero = $ultimo;
            }
            break;
        case "Anterior":
            $primero -= FPAG;
            if ($primero < 0) {
                $primero = 0;
            }
            break;
        case "Ultimo":
            $primero = $ultimo;
            break;
    }
    $_SESSION['posini'] = $primero;
}

$tclientes = $dbh->getClientes($primero, FPAG);
$contenido .= mostrarDatos($tclientes);

include_once "app/layout/principal.php";
