<?php
require_once '../vendor/autoload.php';

use Hybridauth\Hybridauth;
use Hybridauth\Exception\Exception;

try {
    // Configuración de HybridAuth
    $config = require 'hybridauth.php';
    $hybridauth = new HybridAuth($config);

    // Inicializar el adaptador para GitHub
    $adapter = $hybridauth->authenticate('GitHub');

    // Obtener el perfil del usuario
    $userProfile = $adapter->getUserProfile();

    // Guardar los datos del usuario en la sesión
    session_start();
    
    $_SESSION['email'] = $userProfile->email;
    $_SESSION['name'] = $userProfile->displayName;

    // Redirigir a la página principal
    header('Location: ../Controlador/signup.php?github=1');
    exit();
} catch (Exception $e) {
    // Manejar errores
    echo 'Error: ' . $e->getMessage();
}
