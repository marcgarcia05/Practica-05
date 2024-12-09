<?php
session_start(); // Inicia la sesión para almacenar datos del usuario

require_once '../vendor/autoload.php';

// Configuración de Google API
$clientID = '953448223113-aeftrgsnjll8dqgp0mt50lebghd7bqq3.apps.googleusercontent.com'; // Client ID
$clientSecret = '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'; // Client Secret
$redirectUri = 'https://xampp.garc.pro/www/practiques/UF1/Practica%205/Practica-5/Controlador/logingoogle.php';

// Crear cliente de Google
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Procesar la autenticación
if (isset($_GET['code'])) {
    try {
        // Obtener el token de acceso con el código
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);

        // Obtener información del usuario desde Google
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Guardar datos en la sesión
        $_SESSION['email'] = $google_account_info->email;
        $_SESSION['name'] = $google_account_info->givenName;


        // Redirigir al índice
        header("Location: ../Controlador/signup.php?google=1");
        exit();
    } catch (Exception $e) {
        // Manejo de errores
        echo "Error al autenticar: " . $e->getMessage();
    }
} else {
    // Redirigir a Google si no hay código de autenticación
    header("Location: " . $client->createAuthUrl());
    exit();
}
?>
