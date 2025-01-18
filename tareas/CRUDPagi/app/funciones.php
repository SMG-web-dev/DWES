<?php

function mostrarDatos($clientes)
{
    $html = '<div class="table-responsive">'; // Added for responsiveness
    $html .= '<table id="client-table">';
    $html .= '<thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Email</th><th>Género</th><th>Teléfono</th><th>IP</th><th>Acciones</th></tr></thead>';
    $html .= '<tbody>';

    foreach ($clientes as $cliente) {
        $html .= '<tr>';
        $html .= '<td>' . $cliente->id . '</td>';
        $html .= '<td>' . $cliente->first_name . '</td>';
        $html .= '<td>' . $cliente->last_name . '</td>';
        $html .= '<td>' . $cliente->email . '</td>';
        $html .= '<td>' . $cliente->gender . '</td>';
        $html .= '<td>' . $cliente->telefono . '</td>';
        $html .= '<td>' . $cliente->ip_address . '</td>';
        $html .= '<td class="action-column">';
        $html .= '<div class="button-group">'; // Agrupar botones de acción 
        $html .= '<a class="button" href="index.php?orden=Detalles&id=' . $cliente->id . '"><i class="fas fa-info-circle"></i></a> ';
        $html .= '<a class="button" href="index.php?orden=Modificar&id=' . $cliente->id . '"><i class="fas fa-edit"></i></a> ';
        $html .= '<a class="button" href="index.php?orden=Borrar&id=' . $cliente->id . '" onclick="return confirm(\'¿Estás seguro de que deseas borrar este cliente?\');"><i class="fas fa-trash"></i></a>';
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>'; // Close table-responsive
    return $html;
}

function limpiarEntrada(string $entrada): string
{
    $salida = trim($entrada);
    $salida = strip_tags($salida);
    return $salida;
}

function limpiarArrayEntrada(array &$entrada)
{
    foreach ($entrada as $key => $value) {
        $entrada[$key] = limpiarEntrada($value);
    }
}
