// web/js/funciones.js

function confirmarBorrar(nombre, id) {
  if (confirm(`¿Quieres eliminar el usuario: ${nombre}?`)) { // Template literals for better readability
    window.location.href = `?orden=Borrar&id=${id}`; // Template literals
  }
}

function showNotification(message, type = 'success') {
  const notificationContainer = document.getElementById('notification-container');
  if (!notificationContainer) {
    console.error("Notification container not found. Add a div with id='notification-container' to your HTML.");
    return;
  }

  const notification = document.createElement('div');
  notification.classList.add('notification', type, 'show');
  notification.innerHTML = message; // Use innerHTML to render icons

  notification.addEventListener('click', () => {
    notification.remove();
  });

  notificationContainer.appendChild(notification);

  setTimeout(() => {
    notification.remove();
  }, 5000);
}



class ClientTableFilter {
  constructor(tableId) {
    this.table = document.getElementById(tableId);
    if (!this.table) {
      console.error(`Table with ID "${tableId}" not found.`);
      return;
    }
    this.searchInput = document.getElementById('searchInput');
    this.genderFilter = document.getElementById('genderFilter');
    this.sortFilter = document.getElementById('sortFilter');
    this.rows = Array.from(this.table.querySelectorAll('tbody tr'));
    this.bindEvents();
  }

  bindEvents() {
    this.searchInput.addEventListener('input', () => this.filterRows());
    this.genderFilter.addEventListener('change', () => this.filterRows());
    this.sortFilter.addEventListener('change', () => this.filterRows());
  }

  filterRows() {
    const searchTerm = this.searchInput.value.toLowerCase();
    const selectedGender = this.genderFilter.value;
    const sortOrder = this.sortFilter.value;

    this.rows.forEach(row => {
      const name = row.cells[1].textContent.toLowerCase();
      const gender = row.cells[4].textContent.toLowerCase();
      const isVisible =
        (searchTerm === '' || name.includes(searchTerm)) &&
        (selectedGender === '' || gender === selectedGender);
      row.style.display = isVisible ? '' : 'none';
    });

    if (sortOrder !== '') {
      this.sortRows(sortOrder);
    }
  }

  sortRows(sortOrder) {
    this.rows.sort((a, b) => {
      const nameA = a.cells[1].textContent.toLowerCase();
      const nameB = b.cells[1].textContent.toLowerCase();
      const comparison = nameA.localeCompare(nameB);
      return sortOrder === 'nombreAsc' ? comparison : -comparison;
    });
    this.rows.forEach(row => this.table.querySelector('tbody').appendChild(row));
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new ClientTableFilter('client-table');

  // Check for messages from PHP and display notifications
  const message = document.querySelector('#message');
  if (message) {
    const msg = message.textContent.trim();
    if (msg !== "") {
      const type = message.dataset.type || 'success';
      showNotification(msg, type);
    }
  }
});

