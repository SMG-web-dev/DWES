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
        $html .= '<div class="button-group">'; // Agrupar botones de acción
        $html .= '<a class="button" href="index.php?orden=Nuevo"><i class="fas fa-plus"></i></a>'; 
        $html .= '<a class="button" href="index.php?orden=Detalles&id=' . $cliente->id . '"><i class="fas fa-info-circle"></i></a> ';
        $html .= '<a class="button" href="index.php?orden=Modificar&id=' . $cliente->id . '"><i class="fas fa-edit"></i></a> ';
        $html .= '<a class="button" href="index.php?orden=Borrar&id=' . $cliente->id . '" onclick="return confirm(\'¿Estás seguro de que deseas borrar este cliente?\');"><i class="fas fa-trash"></i></a>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
    }
    
    $html .= '</table>';
    return $html;
}

/*
 *  Funciones para limpiar la entrada de posibles inyecciones
 */

function limpiarEntrada(string $entrada): string {
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}

// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada) {
    foreach ($entrada as $key => $value) {
        $entrada[$key] = limpiarEntrada($value);
    }
}

