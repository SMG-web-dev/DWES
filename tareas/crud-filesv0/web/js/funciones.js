/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(nombre, id) {
  if (confirm("¿Quieres eliminar el usuario:  " + nombre + "?")) {
    document.location.href = "?orden=Borrar&id=" + id;
  }
}

/**
 *  Muestra la clave del formulario, cambia de password a text
 */
function mostrarclave() {
  let clave = document.getElementById("clave_id")
  if (clave.getAttribute("type") === "password")
    clave.setAttribute("type", "text")
  else
    clave.setAttribute("type", "password")
}

/**
 *  Pide confirmación de volcar los datos 
 */
function confirmarVolcar() {
  if (confirm("Confirma para volcar los datos:")) {
    console.log("Datos volcados correctamente.");
    return true;
  } else {
    console.log("Operación cancelada.");
    return false;
  }
}