<?php
run();

function run()
{
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        header("Location: captura.html");
        exit();
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        showPlayer();
        exit();
    }
}
function showPlayer()
{
    $player = getPlayer();
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Datos del Jugador</title>
        <link rel="icon" type="image/x-icon" href="calavera.png">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <div class="container">
            <h2>Datos del Jugador</h2>
            <div class="info">
                <p><b>Nombre:</b> <?php echo htmlspecialchars($player->nombre); ?></p>
                <p><b>Alias:</b> <?php echo htmlspecialchars($player->alias); ?></p>
                <p><b>Edad:</b> <?php echo htmlspecialchars($player->edad); ?></p>
                <p><b>Armas:</b> <?php
                                    if (!empty($player->armas))
                                        echo htmlspecialchars(implode(', ', $player->armas));
                                    else
                                        echo 'No hay armas seleccionadas.';
                                    ?></p>
                <p><b>¿Practica artes mágicas?:</b> <?php echo $player->magia ?></p>
            </div>
            <div class="image-container">
                <?php if ($player->imagen): ?>
                    <img src="<?php echo $player->imagen; ?>" alt="Imagen del jugador">
                <?php else: ?>
                    <p><b>No se subió ninguna imagen.</b></p>
                    <img src="calavera.png" alt="Imagen por defecto">
                    <p>Error al subir la imagen</p>
                <?php endif; ?>
            </div>
        </div>
    </body>

    </html>
<?php
}

function getImage()
{
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $uploads_dir = 'uploads/';
        createUploadDirectory($uploads_dir);

        $tmp_name = $_FILES['imagen']['tmp_name'];
        $name = basename($_FILES['imagen']['name']);
        $target_file = $uploads_dir . $name;

        // Validar imagen y tamaño
        $validation_result = validateImageUpload($_FILES['imagen']);
        if ($validation_result === true) {
            move_uploaded_file($tmp_name, $target_file);
            return $target_file; // ruta del archivo subido
        } else {
            echo $validation_result; // mensaje de error
            return null;
        }
    }
    return null;
}

function createUploadDirectory($directory)
{
    if (!file_exists($directory))
        mkdir($directory, 0755, true);
}

function validateImageUpload($file)
{
    if (!isImage($file['tmp_name']))
        return false;
    if (!isFileSizeValid($file['size']))
        return false;
    return true;
}

function isImage($file)
{
    $file_type = mime_content_type($file);
    return strpos($file_type, 'image/') === 0;
}

function isFileSizeValid($size)
{
    return $size <= 2 * 1024 * 1024;
}



function getPlayer()
{
    return (object) [
        'nombre' => $_POST["nombre"],
        'alias' => $_POST["alias"],
        'edad' => $_POST["edad"],
        'armas' => getArmas(),
        'magia' => getMagia(),
        'imagen' => getImage()
    ];
}

function getArmas()
{
    $armas = [];
    if (isset($_POST["armas"]) && is_array($_POST["armas"])) {
        // Filtrar y añadir
        foreach ($_POST["armas"] as $arma)
            if (!empty($arma))
                $armas[] = $arma;
    }
    return $armas;
}

function getMagia()
{
    if (isset($_POST["magia"]))
        return ($_POST["magia"] === "si") ? "Si" : "No";
}
