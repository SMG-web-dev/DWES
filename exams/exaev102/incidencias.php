<?php
// Función para limpiar los datos y evitar inyecciones de HTML/JavaScript
function limpiarDatos($dato)
{
    return htmlspecialchars(stripslashes(trim($dato)), ENT_QUOTES, 'UTF-8');
}

// Comprobamos si la sesión está iniciada, si no lo hacemos
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Archivo de incidencias
$archivo = 'incidencias.txt';

// Verificamos si el límite de incidencias se ha superado
if (isset($_SESSION['ultimas_incidencias']) && count($_SESSION['ultimas_incidencias']) >= 3) {
    $tiempo_total = time() - $_SESSION['ultimas_incidencias'][0];
    if ($tiempo_total < 120) { // Si menos de 2 minutos han pasado
        die('Superado el número máximo de incidencias. Espere 2 minutos para introducir otra o reinicie su navegador.');
    } else {
        // Limpiamos las incidencias antiguas que ya tienen más de 2 minutos
        $_SESSION['ultimas_incidencias'] = array_filter($_SESSION['ultimas_incidencias'], function ($timestamp) {
            return (time() - $timestamp) < 120;
        });
    }
}

// Recibimos y limpiamos los datos del formulario
$nombre = isset($_POST['nombre']) ? limpiarDatos($_POST['nombre']) : '';
$resumen = isset($_POST['resumen']) ? limpiarDatos($_POST['resumen']) : '';
$prioridad = isset($_POST['prioridad']) ? limpiarDatos($_POST['prioridad']) : '';

// Obtenemos la fecha y hora actual
$fechaHora = date('d:m:Y H:i');

// Obtenemos la IP del cliente
$ip = $_SERVER['REMOTE_ADDR'];

// Creamos el contenido de la incidencia
$incidencia = "$fechaHora,$nombre,$resumen,$prioridad,$ip\n";

// Intentamos añadir la incidencia al archivo
if (file_put_contents($archivo, $incidencia, FILE_APPEND | LOCK_EX) !== false) {
    // Registramos el momento de la incidencia en la sesión
    $_SESSION['ultimas_incidencias'][] = time();
    // Mensaje de éxito
    echo "Muchas gracias $nombre, se ha anotado su incidencia.";
} else {
    // En caso de error al escribir el archivo
    echo "Error no se ha podido anotar su incidencia.";
}
