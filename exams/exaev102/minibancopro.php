<?php
session_start();

// Inicializar variables de sesión si no existen
if (!isset($_SESSION['importe'])) $_SESSION['importe'] = 0;
if (!isset($_SESSION['msg'])) $_SESSION['msg'] = "";

if (isset($_POST['Orden'])) {
    $importe = isset($_POST['importe']) ? (int)$_POST['importe'] : 0;

    switch ($_POST['Orden']) {
        case "Ingreso":
            if ($importe <= 0) {
                $_SESSION['msg'] = "Importe inválido. Debe ser mayor a 0.";
            } else {
                $_SESSION['importe'] += $importe;
                $_SESSION['msg'] = "Ingreso realizado con éxito. Nuevo saldo: " . $_SESSION['importe'] . "€.";
            }
            break;

        case "Reintegro":
            if ($importe <= 0) {
                $_SESSION['msg'] = "Importe inválido. Debe ser mayor a 0.";
            } elseif ($importe > $_SESSION['importe']) {
                $_SESSION['msg'] = "Saldo insuficiente. No se puede retirar más del saldo actual.";
            } else {
                $_SESSION['importe'] -= $importe;
                $_SESSION['msg'] = "Reintegro realizado con éxito. Nuevo saldo: " . $_SESSION['importe'] . "€.";
            }
            break;

        case "Ver saldo":
            $_SESSION['msg'] = "Su saldo actual es de " . $_SESSION['importe'] . "€.";
            break;
        case "Terminar":
            session_destroy();
            break;

        default:
            $_SESSION['msg'] = "Operación no reconocida.";
            break;
    }
}

// Redirigir con el mensaje de resultado
header("Location: minibanco.php?msg=" . urlencode($_SESSION['msg']));
exit();
