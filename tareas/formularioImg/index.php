<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Location: captura.html");
    exit();
} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $alias = $_POST["alias"];
    $edad = $_POST["edad"];
    $armas[] = $_POST["armas"];
    $magia = $_POST["magia"];
    $imagen = $_POST["imagen"];

    exit();
}
