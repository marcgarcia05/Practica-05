<?php
session_start();
require_once '../Model/articles.php';

//Guardem el contingut introduït per l'usuari
$titol = $_POST['titol'];
$cos = $_POST['cos'];
$usuariID = $_SESSION['userID'];

//Evitem code injection
$titol = htmlspecialchars($titol);
$cos = htmlspecialchars($cos);

//Generem una llista buida on guardarem els diferents errors de l'usuari
$errors = [];

//Comprovem que el nom no està buit
if (empty($titol)) {
    array_push($errors, "ERROR - TITOL NO POT ESTAR BUIT!!");
    //Comprovem que el nom no conté caràcters estranys
}
//Comprovem que el text no està buit
if (empty($cos)) {
    array_push($errors, "ERROR - COS NO POT ESTAR BUIT!!");
}

//En cas de no tenir cap error, afegim les dades a la BBDD
if (empty($errors)) {
    inserirArticle($titol, $cos, $usuariID);
    //Mostrem el missatge
    $missatge = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>DADES INTRODUIDES CORRECTAMENT!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>";
    session_start();
    $_SESSION['inserir'] = $missatge;
    header("Location: ../Vistes/inserir.view.php");
    exit();
} else {
    //Mostrem els errors
    $missatge = tractarErrors($errors);
    mostrarMissatge($missatge);
}

function tractarErrors($errors) {
    $missatge = "<br><div class='alertes'>";
    foreach ($errors as $error) {
        $missatge .= "<div class='alerta alert alert-danger d-flex align-items-center' role='alert'>$error<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>";
    }
    $missatge .= "</div>";
    return $missatge;
}

function mostrarMissatge($missatge) {
    session_start();
    $_SESSION['inserir'] = $missatge;
    header("Location: ../Vistes/inserir.view.php");
}