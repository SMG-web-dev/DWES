<footer class="footer mt-auto py-4 bg-dark text-white animate__animated animate__fadeIn">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-md-4 text-center text-md-start">
                <a class="navbar-brand d-flex align-items-center justify-content-center justify-content-md-start text-white text-decoration-none" href="index.php">
                    <svg class="bi me-2" width="40" height="32" fill="currentColor">
                        <path d="M8 0l8 8-8 8-8-8 8-8z" />
                    </svg>
                    <span class="fs-5">Task Manager</span>
                </a>
            </div>

            <div class="col-md-4 text-center">
                <div class="social-links">
                    <a href="#" class="text-white mx-2 text-decoration-none hover-effect">
                        <i class="bi bi-facebook fs-5"></i>
                    </a>
                    <a href="#" class="text-white mx-2 text-decoration-none hover-effect">
                        <i class="bi bi-twitter fs-5"></i>
                    </a>
                    <a href="#" class="text-white mx-2 text-decoration-none hover-effect">
                        <i class="bi bi-instagram fs-5"></i>
                    </a>
                    <a href="#" class="text-white mx-2 text-decoration-none hover-effect">
                        <i class="bi bi-linkedin fs-5"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4 text-center text-md-end">
                <p class="mb-0">© <?= date('Y') ?> Task Manager</p>
                <p class="mb-0 text-muted">Todos los derechos reservados</p>
            </div>
        </div>
    </div>

    <style>
        .footer {
            background: linear-gradient(45deg, #1a1a1a, #292929);
        }

        .hover-effect {
            transition: all 0.3s ease;
        }

        .hover-effect:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }

        .social-links a {
            display: inline-block;
        }

        @media (max-width: 767.98px) {
            .social-links {
                margin: 1rem 0;
            }
        }
    </style>
</footer>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>

</html>