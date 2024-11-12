<?php
session_start();
include_once('app/funciones.php');

// Control de intentos fallidos
if (!isset($_SESSION['intentos']))
  $_SESSION['intentos'] = 0;


// Si el formulario es enviado
if (!empty($_GET['login']) && !empty($_GET['key'])) {

  // Si se han superado los intentos fallidos, bloqueamos el acceso
  if ($_SESSION['intentos'] >= 5) {
    $contenido = "Acceso bloqueado. Para intentar nuevamente, cierre el navegador o abra una ventana privada.";
    include_once('app/acceso.php');
    exit();
  }

  // Verificar si los datos del usuario son correctos
  if (userOk($_GET['login'], $_GET['key'])) {

    // Reseteamos los intentos fallidos al loguearse correctamente
    $_SESSION['intentos'] = 0;

    // Determinamos el rol del usuario
    if (getUserRol($_GET['login']) == ROL_PROFESOR)
      // Si es profesor, mostramos las notas de todos
      $contenido = verNotasDeTodos($_GET['login']);
    else
      // Si es alumno, mostramos solo sus notas
      $contenido = verNotasAlumno($_GET['login']);

    // Incluimos el archivo de resultados
    include_once('app/resultado.php');
  } else {
    // Si los datos son incorrectos, incrementamos los intentos fallidos
    $_SESSION['intentos']++;
    $contenido = "El número de usuario y la contraseña no son válidos.";
    include_once('app/acceso.php');
  }
} else {
  // Si no se ha enviado el formulario, mostramos un mensaje de solicitud
  $contenido = "Introduzca su número de usuario y su contraseña.";
  include_once('app/acceso.php');
}
