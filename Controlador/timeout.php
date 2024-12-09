<?php

// Establim el temps màxim d'inactivitat
$tempsMax = 60 * 40;

// Verifiquem si l'usuari està autenticat
if (isset($_SESSION['username'])) {
    // Verifiquem si existeix la variable última activitat
    if (isset($_SESSION['ultima_activitat'])) {
        // Calcular el temps transcorregut des de la darrera activitat
        $temps = time() - $_SESSION['ultima_activitat'];
        
        // Verifiquem el temps que l'usuari porta inactiu
        if ($temps > $tempsMax) {
            // Destruïm la sessió i redirigim a l'usuari amb un missatge d'avis
            session_unset();
            session_destroy();
            setcookie("logout", "<div class='alertes alert alert-warning d-flex align-items-center' role='alert'>ATENCIÓ - LA SESSIO A EXPIRAT!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>", time() + 5);
            header("Location: ../Controlador/index.php");
            exit();
        }
    }

    // Actualitzar el temps de l'última activitat
    $_SESSION['ultima_actividad'] = time();
}
?>
