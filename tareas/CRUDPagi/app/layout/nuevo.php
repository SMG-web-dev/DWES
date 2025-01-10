<div class="modal-overlay" id="modalOverlay">
    <div class="modal-content">
        <div id="header">
            <h1>Agregar Nuevo Cliente</h1>
        </div>
        <form method="POST" action="index.php">
            <input type="hidden" name="orden" value="Nuevo">
            <div class="modal-body">
                <?php if (isset($_SESSION['msg'])): ?>
                    <script>
                        showNotification('<?= htmlspecialchars($_SESSION['msg']) ?>', '<?= isset($_SESSION['msg_type']) ? $_SESSION['msg_type'] : 'success' ?>');
                    </script>
                    <?php
                    unset($_SESSION['msg']);
                    unset($_SESSION['msg_type']);
                    ?>
                <?php endif; ?>
                <div class="form-group">
                    <label for="first_name">Nombre:</label>
                    <input type="text" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Apellido:</label>
                    <input type="text" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="gender">Género:</label>
                    <select name="gender" required>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" name="telefono">
                </div>
                <div class="form-group">
                    <label for="ip_address">IP Address:</label>
                    <input type="text" name="ip_address">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="button">
                    <i class="fas fa-save"></i>
                </button>
                <button type="reset" class="button">
                    <i class="fas fa-undo"></i>
                </button>
                <button type="button" class="button" onclick="window.location='index.php'">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </form>
    </div>
</div>