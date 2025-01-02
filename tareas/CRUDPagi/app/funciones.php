<?php

// MUESTRA TODOS LOS USUARIOS
function mostrarDatos($clientes) {
    $html = '<table>';
    $html .= '<tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Acciones</th></tr>';
    
    foreach ($clientes as $cliente) {
        $html .= '<tr>';
        $html .= '<td>' . $cliente->id . '</td>';
        $html .= '<td>' . $cliente->first_name . '</td>';
        $html .= '<td>' . $cliente->last_name . '</td>';
        $html .= '<td>' . $cliente->email . '</td>';
        $html .= '<td>';
        $html .= '<a class="button" href="index.php?orden=Detalles&id=' . $cliente->id . '">Detalles</a> | ';
        $html .= '<a class="button" href="index.php?orden=Modificar&id=' . $cliente->id . '">Modificar</a> | ';
        $html .= '<a class="button" href="index.php?orden=Borrar&id=' . $cliente->id . '" onclick="return confirm(\'¿Estás seguro de que deseas borrar este cliente?\');">Borrar</a>';
        $html .= '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    return $html;
}

/*
 *  Funciones para limpiar la entreda de posibles inyecciones
 */

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){
 
    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

