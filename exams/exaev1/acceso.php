<?php
session_start();
// Generar el token CSRF
if (empty($_SESSION["token"])) {
    $_SESSION["token"] = md5(uniqid(mt_rand(), true));
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>MiniBank</title>
</head>

<body>
    <?php
    if (isset($_GET['msg'])) echo "RESULTADO: " . htmlspecialchars($_GET['msg']) . "<br>";
    ?>
    <form action="ejercicio01.php" method="POST">
        Importe de la operación: <input name="importe" type="number" step="0.01" autofocus><br>
        <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
        <input type="submit" name="Orden" value="Ingreso">
        <input type="submit" name="Orden" value="Reintegro">
        <input type="submit" name="Orden" value="Ver saldo">
    </form>
</body>

</html>