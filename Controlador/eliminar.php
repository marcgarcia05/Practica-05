<?php
require_once '../Model/articles.php';
session_start();

function eliminar(){
    //Eliminem l'article
    eliminarArticle($_POST['eliminar']);
    //Pasem missatge
    $missatge = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>DADES ELIMINADES CORRECTAMENT<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>";
    return $missatge;
}

if(isset($_POST['eliminar'])){
    $_SESSION['missatge'] = eliminar();
    header("Location: ../Controlador/index.php");
}
?>