<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Paginado</title>
    <link href="web/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container">
        <div id="header">
            <h1>Listado de Clientes</h1>
        </div>
        <div id="content">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Género</th>
                        <th>Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tcli)): ?>
                        <?php foreach ($tcli as $cli): ?>
                            <tr>
                                <td><?= $cli->id ?></td>
                                <td><?= $cli->first_name ?></td>
                                <td><?= $cli->last_name ?></td>
                                <td><?= $cli->email ?></td>
                                <td><?= $cli->gender ?></td>
                                <td><?= $cli->telefono ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No hay clientes disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <form>
                <button name="orden" value="Primero">&#8606; Primero</button>
                <button name="orden" value="Anterior">&#8592; Anterior</button>
                <button name="orden" value="Siguiente">&#8594; Siguiente</button>
                <button name="orden" value="Ultimo">&#8608; Último</button>
            </form>
        </div>
    </div>
</body>

</html>