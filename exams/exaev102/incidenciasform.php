<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Gestión de Incidencias</title>
</head>

<body>
    <h2> Gestión de Incidencias:</h2>
    <form action="incidencias.php" method="post">
        <fieldset>
            Nombre : <input name="nombre" type="text" size="10" required><br>
            Resumen: <br>
            <textarea name="resumen" rows="3" cols="30" required></textarea><br>
            Prioridad:
            <select name="prioridad">
                <option value="4">Baja</option>
                <option value="3">Normal</option>
                <option value="2">Alta</option>
                <option value="1">Urgente</option>
            </select><br>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</body>

</html>