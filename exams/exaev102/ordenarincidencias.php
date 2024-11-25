<?php
// Ruta del archivo de incidencias
$archivo = 'incidencias.txt';

// Comprobamos si el archivo existe
if (!file_exists($archivo)) {
    die("El archivo de incidencias no existe.");
}

// Leemos el archivo línea por línea y almacenamos las líneas en un array
$incidencias = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Creamos un array para almacenar los datos procesados
$datosIncidencias = [];

// Procesamos cada línea del archivo
foreach ($incidencias as $incidencia) {
    // Dividimos la línea en los campos: fecha, nombre, resumen, prioridad, IP
    $campos = explode(',', $incidencia);

    // Verificamos si hay la cantidad correcta de campos
    if (count($campos) == 5) {
        $datosIncidencias[] = [
            'fecha' => $campos[0],
            'nombre' => $campos[1],
            'resumen' => $campos[2],
            'prioridad' => (int)$campos[3], // Convertimos la prioridad a entero
            'ip' => $campos[4]
        ];
    }
}

// Ordenamos el array de incidencias por la prioridad (de mayor a menor)
usort($datosIncidencias, function ($a, $b) {
    return $a['prioridad'] <=> $b['prioridad']; // Comparar prioridades
});

// Volvemos a escribir los datos ordenados en el archivo
$contenidoOrdenado = "";
foreach ($datosIncidencias as $incidencia) {
    $contenidoOrdenado .= implode(',', $incidencia) . "\n";
}

// Escribimos los datos ordenados en el archivo
if (file_put_contents($archivo, $contenidoOrdenado) !== false) {
    echo "El archivo de incidencias ha sido ordenado por prioridad correctamente.";
} else {
    echo "Error al intentar escribir el archivo.";
}
