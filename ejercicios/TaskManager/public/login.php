<?php
require '../includes/conexion.php';
require_once '../includes/funciones.php';

// Verificar si el usuario ya está logueado
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit();
}

// Inicializar mensaje de error
$error = '';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? limpiar_datos($_POST['usuario']) : '';
    $password = isset($_POST['password']) ? limpiar_datos($_POST['password']) : '';

    if (!empty($usuario) && !empty($password)) {
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$usuario]);
        $usuario_db = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario_db) {
            // Verificar la contraseña
            if (password_verify($password, $usuario_db['password'])) {
                $_SESSION['usuario_id'] = $usuario_db['id'];
                $_SESSION['nombre_usuario'] = $usuario_db['nombre_usuario'];

                header('Location: index.php');
                exit();
            } else {
                $error = 'Contraseña incorrecta. Intenta de nuevo.';
            }
        } else {
            $error = 'El usuario no existe.';
        }
    } else {
        $error = 'Por favor, completa todos los campos.';
    }
}


// Incluir el header
include '../layouts/header.php';
?>

<div class="login-page min-vh-100 d-flex align-items-center animate__animated animate__fadeIn">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="text-center mb-5">
                    <i class="bi bi-check-circle-fill display-1 text-primary"></i>
                    <h1 class="h3 mt-3">Bienvenido de nuevo</h1>
                    <p class="text-muted">Ingresa a tu cuenta para continuar</p>
                </div>

                <div class="card border-0 shadow-lg animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="card-body p-4">
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger animate__animated animate__shake" role="alert">
                                <i class="bi bi-exclamation-circle me-2"></i><?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" class="needs-validation" novalidate>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="usuario" name="usuario"
                                    placeholder="Nombre de usuario" required autofocus>
                                <label for="usuario">
                                    <i class="bi bi-person me-2"></i>Nombre de usuario
                                </label>
                                <div class="invalid-feedback">
                                    Por favor ingresa tu nombre de usuario
                                </div>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Contraseña" required>
                                <label for="password">
                                    <i class="bi bi-lock me-2"></i>Contraseña
                                </label>
                                <div class="invalid-feedback">
                                    Por favor ingresa tu contraseña
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg mb-4">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                            </button>

                            <div class="text-center">
                                <p class="text-muted">
                                    ¿No tienes cuenta?
                                    <a href="registro.php" class="text-primary text-decoration-none">
                                        Regístrate aquí
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .login-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .form-floating>label {
        padding-left: 1.75rem;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .animate__animated {
        animation-duration: 0.8s;
    }
</style>

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