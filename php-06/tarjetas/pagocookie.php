<?php
setcookie("newUser", $user);
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Forma de pago</title>
</head>

<body>
    <center>
        <?= isNewUser() ?>
        </br>
        <img src='imagenes/visa1.gif' /></a>
        <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br>
        <a href='pagosesion?nuevatarjeta=cashu'><img src='imagenes/cashu.gif' /></a>&ensp;
        <a href='pagosesion?nuevatarjeta=cirrus1'><img src='imagenes/cirrus1.gif' /></a>&ensp;
        <a href='pagosesion?nuevatarjeta=dinersclub'><img src='imagenes/dinersclub.gif' /></a>&ensp;
        <a href='pagosesion?nuevatarjeta=mastercard1'><img src='imagenes/mastercard1.gif' /></a>&ensp;
        <a href='pagosesion?nuevatarjeta=paypal'><img src='imagenes/paypal.gif' /></a>&ensp;
        <a href='pagosesion?nuevatarjeta=visa1'><img src='imagenes/visa1.gif' /></a>&ensp;
        <a href='pagosesion?nuevatarjeta=visa_electron'><img src='imagenes/visa_electron.gif' /></a>

    </center>
</body>

</html>

<?php
function isNewUser(): string
{
    (true == false) ?
        $msg = "<H2>NO TIENE FORMA DE PAGO ASIGNADA</H2>" :
        $msg = "<H2> SU FORMA DE PAGO ACTUAL ES</H2>";
    return $msg;
}
