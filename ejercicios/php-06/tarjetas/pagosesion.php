<?php
session_start();

// Configuración del tiempo de expiración de la sesión en segundos (por ejemplo, 5 minutos)
$tiempoInactividad = 60; // 1 minutos = 60 segundos

// Verifica si el usuario ha seleccionado una tarjeta y si hay una sesión activa
if (isset($_GET['nuevatarjeta'])) {
    $_SESSION['tarjetaUser'] = $_GET['nuevatarjeta'];
    $_SESSION['ultimo_acceso'] = time(); // Guarda el momento del último acceso
    header("Location: pagosesion.php"); // Recarga la página para evitar repetir el parámetro
    exit();
}

// Si la sesión existe y ha pasado el tiempo de inactividad, se destruye
if (isset($_SESSION['ultimo_acceso'])) {
    $tiempoTranscurrido = time() - $_SESSION['ultimo_acceso'];
    if ($tiempoTranscurrido > $tiempoInactividad) {
        session_unset();     // Limpia la sesión
        session_destroy();   // Destruye la sesión
        header("Location: pagosesion.php"); // Recarga para reflejar el cambio
        exit();
    } else {
        $_SESSION['ultimo_acceso'] = time(); // Actualiza el tiempo de acceso
    }
}

// Función para mostrar el estado actual del método de pago
function mostrarEstadoPago()
{
    if (!isset($_SESSION['tarjetaUser'])) {
        return "<h3>No tiene un método de pago asignado.</h3>";
    } else {
        $tarjeta = htmlspecialchars($_SESSION['tarjetaUser']);
        return "<h3>Su método de pago actual es:</h3><br><img src='imagenes/{$tarjeta}.gif' />";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Forma de pago</title>
</head>

<body>
    <center>
        <!-- Muestra el estado actual del pago -->
        <?= mostrarEstadoPago() ?>

        <h2>SELECCIONE UNA NUEVA TARJETA DE CRÉDITO</h2><br>
        <a href='pagosesion.php?nuevatarjeta=cashu'><img src='imagenes/cashu.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=cirrus1'><img src='imagenes/cirrus1.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=dinersclub'><img src='imagenes/dinersclub.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=mastercard1'><img src='imagenes/mastercard1.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=paypal'><img src='imagenes/paypal.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=visa1'><img src='imagenes/visa1.gif' /></a>&ensp;
        <a href='pagosesion.php?nuevatarjeta=visa_electron'><img src='imagenes/visa_electron.gif' /></a>
    </center>
</body>

</html>