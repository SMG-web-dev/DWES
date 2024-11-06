<?php
// Verificar si el usuario ha seleccionado una nueva tarjeta mediante el parámetro GET
if (isset($_GET['nuevatarjeta'])) {
    // Guardar la selección en una cookie que expire en 5 minutos
    setcookie("tarjetaUser", $_GET['nuevatarjeta'], time() + 300);
    // Recargar la página para mostrar la tarjeta sin el parámetro en la URL
    header("Location: pagocookie.php");
    exit();
}

// Función para mostrar el estado actual del método de pago
function mostrarEstadoPago()
{
    if (!isset($_COOKIE['tarjetaUser'])) {
        // No existe un método de pago en la cookie
        return "<h3>No tiene un método de pago asignado.</h3>";
    } else {
        // Mostrar el método de pago actual usando la cookie
        $tarjeta = htmlspecialchars($_COOKIE['tarjetaUser']);
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
        <a href='pagocookie.php?nuevatarjeta=cashu'><img src='imagenes/cashu.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=cirrus1'><img src='imagenes/cirrus1.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=dinersclub'><img src='imagenes/dinersclub.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=mastercard1'><img src='imagenes/mastercard1.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=paypal'><img src='imagenes/paypal.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=visa1'><img src='imagenes/visa1.gif' /></a>&ensp;
        <a href='pagocookie.php?nuevatarjeta=visa_electron'><img src='imagenes/visa_electron.gif' /></a>
    </center>
</body>

</html>