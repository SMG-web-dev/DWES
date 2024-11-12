<?php
session_start();

// Inicializar la variable de la tabla de compras
$compraRealizada = "";

// Lógica para reiniciar la sesión si se recibe el parámetro `reset`
if (isset($_GET['reset'])) {
    session_destroy();
    session_start();
    header("Location: index.php");
    exit();
}

// Guardar el nombre del cliente en la sesión la primera vez
if (isset($_GET["cliente"]) && !isset($_SESSION["cliente"])) {
    $_SESSION["cliente"] = $_GET["cliente"];
}

// Procesar formulario de compra de frutas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fruta']) && isset($_POST['cantidad'])) {
    $fruta = $_POST['fruta'];
    $cantidad = intval($_POST['cantidad']);

    // Guardar o acumular el pedido de fruta en la sesión
    if (isset($_SESSION['pedidos'][$fruta])) {
        $_SESSION['pedidos'][$fruta] += $cantidad;
    } else {
        $_SESSION['pedidos'][$fruta] = $cantidad;
    }

    // Generar la tabla de pedidos actuales en $compraRealizada
    $compraRealizada = "<table>
        <tr>
            <th>Fruta</th>
            <th>Cantidad</th>
        </tr>";
    foreach ($_SESSION['pedidos'] as $fruta => $cantidad) {
        $compraRealizada .= "<tr>
            <td>" . htmlspecialchars($fruta) . "</td>
            <td>" . htmlspecialchars($cantidad) . "</td>
        </tr>";
    }
    $compraRealizada .= "</table>";

    // Redirigir a 'despedida.php?compra=' si el usuario hace clic en "Terminar"
    if (isset($_POST['accion']) && $_POST['accion'] === ' Terminar ') {
        header("Location: web/despedida.php?compra=" . urlencode($compraRealizada));
        exit();
    }
}

// Mostrar el formulario de bienvenida o el formulario de compra
if (isset($_SESSION['cliente']))
    include_once("web/compra.php");
else
    include_once("web/bienvenida.php");
