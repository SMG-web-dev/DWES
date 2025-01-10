/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(nombre, id) {
  if (confirm("¿Quieres eliminar el usuario: " + nombre + "?")) {
    document.location.href = "?orden=Borrar&id=" + id;
  }
}

function showNotification(message, type = 'success') {
  const notification = document.createElement('div');
  notification.className = `notification ${type}`;
  notification.textContent = message;

  document.body.appendChild(notification);
  notification.offsetHeight; // Forzar reflow

  notification.classList.add('show');

  setTimeout(() => {
    notification.classList.remove('show');
    setTimeout(() => {
      notification.remove();
    }, 300);
  }, 3000);
}
