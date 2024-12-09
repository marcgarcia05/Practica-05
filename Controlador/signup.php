<?php
session_start();
include '../Model/usuaris.php';
function signup(){
    require_once '../Model/connexio.php';

    //Guardem el contingut introduït per l'usuari
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password_'];

    //Evitem code injection
    $nom = htmlspecialchars($nom);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $password2 = htmlspecialchars($password2);

    $_SESSION['nom'] = $nom;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    //Generem una llista buida on guardarem els diferents errors de l'usuari
    $errors = [];

    //Comprovem que el nom no està buit
    if (empty($nom)) {
        array_push($errors, "ERROR - EL NOM NO POT ESTAR BUIT!!");
    }

    //Comprovem la fortaleza de la password
    $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
    if ($password == "" || $password2 == ""){
        array_push($errors, "ERROR - EL PASSWORD NO POT ESTAR BUIT!!");
    } else if ($password != $password2) {
        array_push($errors, "ERROR - LES PASSWORDS NO COINCIDEIXEN!!");
    } else if (preg_match($password_regex, $password) == 0) {
        array_push($errors, "ERROR - PASWORD MOLT DEBIL!!");
    }

    //Comprovem que el correu no està buit
    if (empty($email)) {
        array_push($errors, "ERROR - EMAIL NO POT ESTAR BUIT!!");
        //Comprovem que el correu té un format correcte
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "ERROR - EL FORMAT DEL EMAIL NO ES CORRECTE!!");
    } else if (getUsuari($email)){
        array_push($errors, "ERROR - JA EXISTEIX UN COMPTE AMB AQUEST EMAIL!!");
    }

    //En cas de no tenir cap error, afegim les dades a la BBDD
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        inserirUsuari($nom, $email, $hash);
        //Mostrem el missatge
        $missatge = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>REGISTRAT CORRECTAMENT!!</div>";
        $_SESSION['signup'] = $missatge;
        header("Location: ../Vistes/signup.view.php");
        exit();
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
    $_SESSION['signup'] = $missatge;
    header("Location: ../Vistes/signup.view.php");
    exit();
}

if (isset($_POST['signup'])) {
    signup();
} else if (isset($_GET['google'])){
    $resultat = getUsuari($_SESSION['email']);
    print_r($resultat);
    if (!isset($resultat["ID"])){
        inserirUsuariGoogle($_SESSION['name'], $_SESSION['email']);
    }
    $resultat = getUsuari($_SESSION['email']);
    $_SESSION['userID'] = $resultat['ID'];
    $_SESSION['username'] = $resultat['Nom_usuari'];
    $_SESSION['admin'] = $resultat['admin'];
    $_SESSION['google'] = $resultat['Google'];
    $_SESSION['missatge'] = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>SESSIÓ INICIADA CORRECTAMENT!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    $_SESSION['login_attempts'] = 0;
    header("Location: ../Controlador/index.php?page=1");

} else if (isset($_GET['github'])){
    $resultat = getUsuari($_SESSION['email']);
    if (!isset($resultat["ID"])){
        inserirUsuariGithub($_SESSION['name'], $_SESSION['email']);
    }
    $resultat = getUsuari($_SESSION['email']);
    $_SESSION['userID'] = $resultat['ID'];
    $_SESSION['username'] = $resultat['Nom_usuari'];
    $_SESSION['admin'] = $resultat['admin'];
    $_SESSION['google'] = $resultat['Github'];
    $_SESSION['missatge'] = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>SESSIÓ INICIADA CORRECTAMENT!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    $_SESSION['login_attempts'] = 0;
    header("Location: ../Controlador/index.php?page=1");

}
 