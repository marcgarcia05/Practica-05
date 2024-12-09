<?php
session_start();

// Inicializar el contador de intentos fallidos
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estils/login.css">
    <link rel="stylesheet" href="../Estils/button.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 mt-3">
                                <img src="https://internship4you.com/assets/img/webp/login-img.webp" class="img-fluid" alt="Login Image">
                            </div>
                            <div class="position-relative">
                                <div class="position-absolute top-0 start-0">
                                    <a href="../Vistes/index.view.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 align-items-center order-1 order-lg-2">
                                <form method="POST" action="../Controlador/login.php">
                                    <div class="divider d-flex align-items-center my-4">
                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Iniciar sessió</p>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" />
                                        <label class="form-label">Email</label>
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : ''; ?>" />
                                        <label class="form-label">Password</label>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="../Vistes/forgotpasswd.view.php" class="text-body">Forgot password?</a>
                                    </div>
                                    <?php if ($_SESSION['login_attempts'] >= 3): ?>
                                        <div class="g-recaptcha" data-sitekey="6LeCepAqAAAAANEgWrjJvKiFpWjAL9KZXmYkyVFI"></div>
                                    <?php endif; ?>
                                    <div class="text-center text-lg-start mt-4 pt-2">
                                        <button type="submit" name="login" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                        <label class="form-check-label">
                                            No tens compte? <a href="../Vistes/signup.view.php">Registre't!</a>
                                        </label>
                                    </div>

                                    <!-- Botón de Google -->
                                    <div class="text-center text-lg-start mt-4 pt-2">
                                        <a href="../Vistes/logingoogle.view.php" class="btn btn-warning d-flex align-items-center justify-content-center">
                                            <img src="../IMG/google.png" alt="Google Icon" style="width:20px; height:20px; margin-right:8px;">
                                            Sign in with Google
                                        </a>
                                    </div>
                                    <div class="text-center text-lg-start mt-1 pt-2">
                                        <a href="../Controlador/logingithub.php" class="btn btn-danger d-flex align-items-center justify-content-center">
                                            <img src="../IMG/github.png" alt="Github Icon" style="width:20px; height:20px; margin-right:8px;">
                                            Sign in with Github
                                        </a>
                                    </div>

                                    <?php
                                    // Mostrar mensajes
                                    if (isset($_SESSION['login'])) {
                                        echo '<div class="alert alert-danger mt-3">' . htmlspecialchars($_SESSION['login']) . '</div>';
                                        unset($_SESSION['login']);
                                    }
                                    if (isset($_SESSION['passwd'])) {
                                        echo '<div class="alert alert-danger mt-3">' . htmlspecialchars($_SESSION['passwd']) . '</div>';
                                        unset($_SESSION['passwd']);
                                    }
                                    
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
