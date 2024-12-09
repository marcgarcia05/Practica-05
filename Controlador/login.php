<?php
require_once '../Model/usuaris.php';
session_start();

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

function login(){
    //Guardem el contingut introduït per l'usuari
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Evitem code injection
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
   
    //Generem una llista buida on guardarem els diferents errors de l'usuari
    $errors = [];

    //Comprovem la fortaleza de la password
    if (empty($password)) {
        array_push($errors, "ERROR - EL PASSWORD NO POT ESTAR BUIT!!");
    }

    //Comprovem que el correu no està buit
    if (empty($email)) {
        array_push($errors, "ERROR - EMAIL NO POT ESTAR BUIT!!");
        //Comprovem que el correu té un format correcte
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "ERROR - EL FORMAT DEL EMAIL NO ES CORRECTE!!");
    } elseif (!getUsuari($email)){
        array_push($errors, "ERROR - AQUEST CORREU NO EXISTEIX!!");
    }

    //En cas de no tenir cap error, afegim les dades a la BBDD
    if (empty($errors)) {
        $resultat = getUsuari($email);
        if (password_verify($password, $resultat['Contrasenya'])) {
            $_SESSION['userID'] = $resultat['ID'];
            $_SESSION['username'] = $resultat['Nom_usuari'];
            $_SESSION['admin'] = $resultat['admin'];
            $_SESSION['missatge'] = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>SESSIÓ INICIADA CORRECTAMENT!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            $_SESSION['login_attempts'] = 0; // Reset login attempts
            header("Location: ../Controlador/index.php?page=1");
        } else {
            $_SESSION['login_attempts']++;
            $missatge = "<div class='alertes alert alert-danger d-flex align-items-center' role='alert'>ERROR - PASSWORD INCORRECTE!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            mostrarMissatge($missatge);
        }
    } else {
        //Mostrem els errors
        $missatge = tractarErrors($errors);
        mostrarMissatge($missatge);
    }
}

function tractarErrors($errors){
    $missatge = "<br><div class='alertes'>";
    foreach ($errors as $error) {
        $missatge = $missatge . "<div class='alerta z-3 text-end alert alert-danger' role='alert'>" . $error . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
    $missatge = $missatge . "</div>";
    return $missatge;
}

function mostrarMissatge($missatge){
    $_SESSION['login'] = $missatge;
    header("Location: ../Vistes/login.view.php");
}

if (isset($_POST['login'])) {
    // Verificar reCAPTCHA si es necesario
    if ($_SESSION['login_attempts'] >= 3) {
        $recaptchaResponse = $_POST['g-recaptcha-response'];
        $secretKey = '6LeCepAqAAAAAIDPbIiuswfS3LFWWk4oWfsXOUCu'; // Reemplaza con tu clave secreta de reCAPTCHA
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
        $responseKeys = json_decode($response, true);

        if (intval($responseKeys["success"]) !== 1) {
            $missatge = "<div class='alertes alert alert-danger d-flex align-items-center' role='alert'>ERROR - COMPLETA EL reCAPTCHA!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            mostrarMissatge($missatge);
            exit;
        }
    }
    login();
}