<?php
define('FPAG', 10); // Número de clientes por página

require_once "app/Cliente.php";
require_once  "app/AccesoDAO.php";
session_start();

// Valor por defecto de la posición inicial
if (!isset($_SESSION['posini'])) {
    $_SESSION['posini'] = 0;
}

$dbh = AccesoDAO::getModelo();
$totalClientes = $dbh->getNumClientes();

$module = $totalClientes % FPAG;
($module == 0) ? $last = $totalClientes - FPAG
    : $last = $totalClientes - $module;

$posini = $_SESSION['posini'];

// Segun la paginación se cambia la posición inicial
if (isset($_GET['orden'])) {
    switch ($_GET['orden']) {
        case "posini":
            $posini = 0;
            break;
        case "Siguiente":
            $posini += FPAG;
            break;
        case "Anterior":
            $posini -= FPAG;
            if ($posini < 0) $posini = 0;
            break;
        case "Último":
            $posini = $last;
            break;
    }
    $_SESSION['posini'] = $posini;
}

$tcli = $dbh->getclientes($posini, FPAG);

// Acceder a la base de datos y pedir los clientes de la página
// Guardar en la variable en una tabla
// Mostrar la tabla en la vista

include "app/plantillas/principal.php";
