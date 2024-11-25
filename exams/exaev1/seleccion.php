<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Selección de personal</title>
</head>

<body>
    <h2> Datos de candidato: Paso 2º </h2>
    <form action="seleccion.php" method="POST">
        <fieldset>
            <legend>Datos Profesionales</legend>
            Nombre: <input type="text" name="nombre" required><br>
            Lenguajes de programación:<br>
            <select name="lenguajes[]" multiple="multiple" size="6">
                <option value="Java">Java</option>
                <option value="JavaScript">JavaScript</option>
                <option value="Php">Php</option>
                <option value="Python">Python</option>
                <option value="Perl">Perl</option>
                <option value="C#">C#</option>
            </select><br>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</body>

</html>


<?php
// Aseguramos que los datos se envíen por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el nombre del candidato
    $user = $_POST['nombre'];

    // Obtener los lenguajes seleccionados
    $lenguajes = isset($_POST['lenguajes']) ? $_POST['lenguajes'] : [];

    // Validar si el candidato sabe algún lenguaje
    if (empty($lenguajes)) {
        echo "<h2>El candidato " . htmlspecialchars($user) . " no sabe ningún lenguaje, por ahora.</h2>";
    } else {
        // Convertir el array de lenguajes a una cadena separada por comas
        $lenguajes_str = implode(", ", $lenguajes);
        echo "<h2>El candidato " . htmlspecialchars($user) . " sabe " . $lenguajes_str . ".</h2>";
    }
}
?>