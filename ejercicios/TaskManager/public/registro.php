<?php
require '../includes/conexion.php';
require_once '../includes/funciones.php';

// Inicializar mensaje de error
$error = '';
$success = '';

// Procesar formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? limpiar_datos($_POST['usuario']) : '';
    $password = isset($_POST['password']) ? limpiar_datos($_POST['password']) : '';

    if (!empty($usuario) && !empty($password)) {
        try {
            // Verificar si el nombre de usuario ya existe
            $sql = "SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$usuario]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $error = 'El nombre de usuario ya está en uso.';
            } else {
                // Insertar el nuevo usuario
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                $sql = "INSERT INTO usuarios (nombre_usuario, password) VALUES (?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$usuario, $hashed_password]);

                $success = 'Usuario registrado con éxito. ¡Puedes iniciar sesión ahora!';
            }
        } catch (Exception $e) {
            $error = 'Hubo un error al registrar el usuario. Intenta nuevamente.';
        }
    } else {
        $error = 'Por favor, completa todos los campos.';
    }
}

// Incluir el header
include '../layouts/header.php';
?>

<div class="register-page min-vh-100 d-flex align-items-center animate__animated animate__fadeIn">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="text-center mb-5">
                    <i class="bi bi-person-plus-fill display-1 text-primary"></i>
                    <h1 class="h3 mt-3">Crear cuenta nueva</h1>
                    <p class="text-muted">Únete a nosotros y comienza a organizar tus tareas</p>
                </div>

                <div class="card border-0 shadow-lg animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card-body p-4">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger animate__animated animate__shake" role="alert">
                                <i class="bi bi-exclamation-circle me-2"></i><?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($success)): ?>
                            <div class="alert alert-success animate__animated animate__bounceIn" role="alert">
                                <i class="bi bi-check-circle me-2"></i><?= htmlspecialchars($success); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="needs-validation" novalidate>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control custom-input" id="usuario" name="usuario"
                                    placeholder="Nombre de usuario" required autofocus
                                    pattern="[A-Za-z0-9]{3,}"
                                    title="Mínimo 3 caracteres, solo letras y números">
                                <label for="usuario">
                                    <i class="bi bi-person me-2"></i>Nombre de usuario
                                </label>
                                <div class="invalid-feedback">
                                    El nombre de usuario debe tener al menos 3 caracteres
                                </div>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control custom-input" id="password" name="password"
                                    placeholder="Contraseña" required
                                    pattern=".{6,}"
                                    title="Mínimo 6 caracteres">
                                <label for="password">
                                    <i class="bi bi-lock me-2"></i>Contraseña
                                </label>
                                <div class="invalid-feedback">
                                    La contraseña debe tener al menos 6 caracteres
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg btn-block custom-button">
                                    <i class="bi bi-person-plus me-2"></i>Registrarse
                                </button>

                                <div class="separator">o</div>

                                <button type="button" class="btn btn-outline-secondary btn-lg btn-block social-button">
                                    <i class="bi bi-google me-2"></i>Registrarse con Google
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <p class="text-muted">
                                    ¿Ya tienes cuenta?
                                    <a href="login.php" class="text-primary text-decoration-none custom-link">
                                        Inicia sesión aquí
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <small class="text-muted">
                        Al registrarte, aceptas nuestros
                        <a href="#" class="text-primary custom-link">Términos</a> y
                        <a href="#" class="text-primary custom-link">Política de Privacidad</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Validación de formulario
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

<?php include '../layouts/footer.php'; ?>