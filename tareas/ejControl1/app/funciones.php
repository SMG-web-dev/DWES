<?php
require_once('dat/datos.php');
/**
 * Verifica si el código de usuario y la clave coinciden con los registros.
 * @param string $login Código del usuario
 * @param string $key Clave del usuario
 * @return bool Retorna true si los datos son correctos, false si no lo son
 */
function userOk($login, $key): bool
{
    global $users;
    // Verificar que el código existe y la clave coincide
    return isset($users[$login]) && $users[$login][1] === $key;
}

/**
 * Obtiene el rol del usuario
 * @param string $login Código del usuario
 * @return int Retorna el rol del usuario, puede ser ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login)
{
    global $users;
    // Verificar si el código de usuario existe y retornar el rol correspondiente
    return isset($users[$login]) ? $users[$login][2] : null;
}

/**
 * Muestra las notas del alumno.
 * @param string $codigo Código del alumno
 * @return string Devuelve una cadena con las notas del alumno en formato HTML
 */
function verNotasAlumno($codigo): string
{
    global $modules, $notas, $users;
    // Verificar si el código de alumno existe
    if (!isset($notas[$codigo]))
        return "<p>El código de alumno no existe.</p>";

    // Obtenemos el nombre del alumno
    $nombreAlumno = $users[$codigo][0];

    // Creamos la tabla de notas
    $msg = "<h2>Bienvenido/a, $nombreAlumno</h2>";
    $msg .= "<table border='1' style='width:100%; border-collapse: collapse;'>
    <thead><tr><th>Asignatura</th><th>Nota</th></tr></thead><tbody>";

    // Iteramos sobre las asignaturas y las notas
    foreach ($modules as $index => $modulo) {
        $nota = isset($notas[$codigo][$index]) ? $notas[$codigo][$index] : 'N/A';
        $msg .= "<tr><td>$modulo</td><td>$nota</td></tr>";
    }
    $msg .= "</tbody></table>";
    return $msg;
}

/**
 * Muestra las notas de todos los alumnos si el usuario tiene rol de profesor.
 * @param string $codigo Código del profesor
 * @return string Devuelve una cadena con la tabla de notas de todos los alumnos
 */
function verNotasDeTodos($codigo): string
{
    global $modules, $notas, $users;
    // Verificamos si el usuario tiene rol de profesor
    if (getUserRol($codigo) !== ROL_PROFESOR)
        return "<p>No tienes permisos para acceder a esta información.</p>";

    // Mostramos la tabla de notas de todos los alumnos
    $msg = "<h2>Notas de los alumnos:</h2>";
    $msg .= "<table border='1' style='width:100%; border-collapse: collapse;'>
    <thead><tr><th>Alumno</th>";

    // Generamos las cabeceras con los nombres de los módulos
    foreach ($modules as $modulo)
        $msg .= "<th>$modulo</th>";
    $msg .= "</tr></thead><tbody>";

    // Iteramos sobre todos los usuarios y mostramos las notas
    foreach ($notas as $codigoAlumno => $notasAlumno) {
        $nombreAlumno = isset($users[$codigoAlumno]) ? $users[$codigoAlumno][0] : "Desconocido";
        $msg .= "<tr><td>$nombreAlumno</td>";

        // Añadimos las notas del alumno
        foreach ($notasAlumno as $nota)
            $msg .= "<td>$nota</td>";
        $msg .= "</tr>";
    }
    $msg .= "</tbody></table>";
    return $msg;
}
