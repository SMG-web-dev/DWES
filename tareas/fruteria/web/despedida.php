<!DOCTYPE html>
<html><head>
<meta charset="UTF-8">
<title>LA FRUTERIA</title>
<link href="default.css" rel="stylesheet" type="text/css" />
</head><body>
<h1>La Frutería del siglo XXI</h1><br>
<form>
<h2>Muchas gracias, por hacer su pedido.</h2>
<?= isset($_GET['compra']) ? $_GET['compra'] : '' ?>
</form><br><br>

<!-- Botón "NUEVO CLIENTE" que termina la sesión y recarga la página de bienvenida -->
<input type="button" value=" NUEVO CLIENTE " onclick="resetSession()">
<script>
function resetSession() {
    fetch('../index.php?reset=1')
        .then(() => {
            window.location.href = '../index.php';
        })
        .catch(error => console.error('Error al reiniciar la sesión:', error));
}
</script></body></html>