<?php
session_start();

// Eliminar sesión si la acción es "reset" (llegada desde JavaScript)
if (isset($_GET['reset'])) {
    session_destroy();
    session_start();  // Iniciar una nueva sesión vacía después de destruirla
}

// Guardar el cliente en la sesión
if (isset($_GET["cliente"]) && !isset($_SESSION["cliente"])) {
    $_SESSION["cliente"] = $_GET["cliente"];
}

// Procesar el formulario de pedido de frutas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fruta']) && isset($_POST['cantidad'])) {
    $fruta = $_POST['fruta'];
    $cantidad = intval($_POST['cantidad']);

    // Almacenar la fruta y cantidad en la sesión
    if (isset($_SESSION['pedidos'][$fruta])) {
        $_SESSION['pedidos'][$fruta] += $cantidad;
    } else {
        $_SESSION['pedidos'][$fruta] = $cantidad;
    }

    // Redirigir a despedida.php si el usuario hace clic en "Terminar"
    if (isset($_POST['accion']) && $_POST['accion'] === ' Terminar ') {
        header("Location: despedida.php");
        exit();
    }
}

// Mostrar bienvenida o formulario de compra
if (isset($_SESSION['cliente'])) {
    include_once("compra.php");
} else {
    include_once("bienvenida.php");
}
?>

<script>
    function nuevoCliente() {
        // Enviar una solicitud a la misma página con el parámetro reset
        fetch('index.php?reset=1')
            .then(() => {
                // Recargar la página una vez eliminada la sesión
                location.reload();
            })
            .catch(error => console.error('Error al reiniciar la sesión:', error));
    }
</script>