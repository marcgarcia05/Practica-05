<?php
session_start();
include '../Model/articles.php';

//Mostrem el article a modificar
function mostrarModificar($id){
    $article = consultarArticle($id);
    $_SESSION['id'] = $id;
    $_SESSION['titol'] = $article['Titol'];
    $_SESSION['cos'] = $article['Cos'];
    header("Location: ../Vistes/modificar.view.php");
}

//Modifiquem l'article editat
function modificar($id, $titol, $cos) {
    $id = htmlspecialchars($id);
    $titol = htmlspecialchars($titol);
    $cos = htmlspecialchars($cos);

    $errors = validarDades($titol, $cos, $id);
    if (empty($errors)) {
        if (count(consultarArticle($id)) == 0) {
            $_SESSION['missatge'] = "<p>ERROR - AQUEST ID NO EXISTEIX!</p>";
        } else {
            modificarArticle($id, $titol, $cos);
            $_SESSION['missatge'] = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>DADES ACTUALITZADES CORRECTAMENT<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>";
        }
        header("Location: ../Controlador/index.php");
    } else {
        mostrarMissatge("modificar", tractarErrors($errors));
    }
}

function validarDades($titol, $cos, $id){
    $errors = [];
    if (empty($id)) {
        array_push($errors, "ERROR - ID NO POT ESTAR BUIT!!");
    }
    if (empty($titol)) {
        array_push($errors, "ERROR - TITOL NO POT ESTAR BUIT!!");
    }
    if (empty($cos)) {
        array_push($errors, "ERROR - COS NO POT ESTAR BUIT!!");
    }
    return $errors;
}

function tractarErrors($errors){
    $missatge = "<br><div class='alertes'>";
    foreach ($errors as $error) {
        $missatge = $missatge . "<div class='alerta z-3 text-end alert alert-danger' role='alert'>" . $error . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
    }
    $missatge = $missatge . "</div>";
    return $missatge;
}

function mostrarMissatge($crud, $missatge){
    session_start();
    $_SESSION['modificar'] = $missatge;
    header("Location: ../Vistes/$crud.view.php");
}

if (isset($_POST['mostrarModificar'])){
    mostrarModificar($_POST['mostrarModificar']);
} elseif (isset($_POST['modificar'])){
    modificar($_POST['idArticle'], $_POST['titol'], $_POST['cos']);
}
?>