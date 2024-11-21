<?php
// Borra el elemento indicado de tabla de usuarios
// Reordena indexa la tabla
function accionBorrar($id)
{
    // Verificar si el usuario existe
    if (!isset($_SESSION['tuser'][$id])) {
        $_SESSION['msg'] = "Usuario no existe o ya ha sido eliminado.";
        return;
    }

    // Eliminar el usuario
    unset($_SESSION['tuser'][$id]);

    // Reindexar la tabla si es un array secuencial
    $_SESSION['tuser'] = array_values($_SESSION['tuser']);

    // Mensaje de éxito
    $_SESSION['msg'] = "Usuario eliminado correctamente.";
}


// Termina: Cierra sesión y vuelca los datos
function accionTerminar()
{
    volcarDatos($_SESSION['tuser']);
    session_destroy();
    $_SESSION['msg'] = "  Todos datos se han guardado ";
}


// Muestra un formularios con los datos de un usuario de la posición $id de la tabla
function accionDetalles($id)
{
    $login = $id;
    $usuario = $_SESSION['tuser'][$id];
    $clave  =   $usuario[0];
    $nombre   = $usuario[1];
    $comentario = $usuario[2];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

// Muestra  el formularios con los datos permitiendo la modificación
function accionModificar($id)
{
    $login = $id;
    $usuario = $_SESSION['tuser'][$id];
    $clave  = $usuario[0];
    $nombre  = $usuario[1];
    $comentario = $usuario[2];
    $orden = "Modificar";
    include_once "layout/formulario.php";
    exit();
}

// Modifica el contenido de usuario
function accionPostModificar()
{
    $id = $_POST['login'];

    // Validar que el usuario existe
    if (!isset($_SESSION['tuser'][$id])) {
        $_SESSION['msg'] = "Usuario no encontrado.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Actualizar los datos del usuario
    $_SESSION['tuser'][$id] = [
        'clave' => $_POST['clave'],
        'nombre' => $_POST['nombre'],
        'comentario' => $_POST['comentario']
    ];

    $_SESSION['msg'] = "Usuario con login $id actualizado.";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}



// Muestra  el formulario con los datos vacios para realizar una alta
function accionAlta()
{
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden = "Nuevo";
    include_once "layout/formulario.php";
    exit();
}

// Proceso los datos del formularios guardándolo en la sesión
// Debe evitar que se puedan introducir dos usuarios con el mismo login y
// que exista algún campo vacio.

function accionPostAlta()
{
    // Sanitizamos los datos de entrada
    limpiarArrayEntrada($_POST);

    // Verificar si todos los campos están completos
    if (
        empty($_POST['login']) ||
        $_POST['clave'] === '' ||
        $_POST['nombre'] === '' ||
        $_POST['comentario'] === ''
    ) {
        $_SESSION['msg'] = "Rellene todos los campos requeridos.";
        return;
    }

    // Validar si el usuario ya existe
    $login = $_POST['login'];
    if (isset($_SESSION['tuser'][$login])) {
        $_SESSION['msg'] = "Nombre de usuario ya existe, prueba de nuevo.";
        return;
    }

    // Agregar el nuevo usuario
    $nuevo = [
        'clave' => $_POST['clave'],
        'nombre' => $_POST['nombre'],
        'comentario' => $_POST['comentario']
    ];
    $_SESSION['tuser'][$login] = $nuevo;

    $_SESSION['msg'] = "Nuevo usuario añadido.";
}
