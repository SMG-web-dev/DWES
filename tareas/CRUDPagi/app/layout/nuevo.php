<div class="modal-overlay" id="modalOverlay">
    <div class="modal-content">
        <div id="header">
            <h1>Agregar Nuevo Cliente</h1>
        </div>
        <form method="POST" action="index.php?orden=Nuevo">
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="genero">Género:</label>
                    <select name="genero" required>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" name="telefono">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="button">
                    <i class="fas fa-save"></i>
                </button>
                <button type="reset" class="button">
                    <i class="fas fa-undo"></i>
                </button>
                <button type="button" class="button" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </form>
    </div>
</div> 
<script>
        function closeModal() {
            const modal = document.getElementById('modalOverlay');
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300); // Espera a que la animación de desvanecimiento termine
        }
    </script>