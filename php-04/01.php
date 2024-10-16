<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == 'admin' && $password == '12345') {
        $_SESSION['message'] = "Inicio de sesión exitoso.";
        header("Location: https://smg-dev-portfolio.netlify.app/");
        exit();
    } else {
        $_SESSION['message'] = "Credenciales incorrectas.";
        header("Location: 01.html");
        exit();
    }
}
?>