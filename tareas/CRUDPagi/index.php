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
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['orden']) && in_array($_GET['orden'], ['Nuevo', 'Borrar', 'Modificar', 'Detalles', 'Terminar', 'Primero', 'Siguiente', 'Anterior', 'Ultimo'])) {
        switch ($_GET['orden']) {
            case "Nuevo":
                accionCrear();
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

// Lógica de paginación
if (!isset($_SESSION['posini'])) {
    $_SESSION['posini'] = 0;
}

$dbh = AccesoDAO::getModelo();

// Manejo de errores al obtener el total de clientes
try {
    $numclientes = $dbh->totalClientes();
} catch (Exception $e) {
    $numclientes = 0; // O manejar de otra manera
}

// Cálculo de la posición final
$ultimo = max(0, $numclientes - FPAG);
$primero = $_SESSION['posini'];

// Manejo de la paginación
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

// Obtener los clientes para mostrar
$tclientes = $dbh->getClientes($primero, FPAG);
$contenido .= mostrarDatos($tclientes);

// Mostrar la página principal
include_once "app/layout/principal.php";




