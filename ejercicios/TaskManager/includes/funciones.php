<?php

/**
 * Verifica si el usuario está autenticado.
 * Si no lo está, lo redirige al login.
 */
function verificar_sesion()
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: login.php');
        exit();
    }
}

/**
 * Limpia y sanitiza datos para evitar inyecciones XSS.
 *
 * @param string $dato Dato a limpiar.
 * @return string Dato limpio y seguro.
 */
function limpiar_datos($dato)
{
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

/**
 * Muestra mensajes de éxito o error en la página.
 *
 * @param string $tipo Tipo de mensaje ('success' o 'error').
 * @param string $mensaje Mensaje a mostrar.
 * @return string HTML del mensaje.
 */
function mostrar_mensaje($tipo, $mensaje)
{
    $clase = $tipo === 'success' ? 'alert-success' : 'alert-danger';
    return "<div class='alert $clase alert-dismissible fade show' role='alert'>
                $mensaje
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
}
