<?php
session_start();
include_once '../Model/usuaris.php';
include_once '../Model/articles.php';

if (!isset($_SESSION['userID'])) {
    header('Location: ../Vistes/login.view.php');
}

if ($_SESSION['admin'] != 1) {
    header('Location: ../Vistes/index.view.php');
}

if (!isset($_GET['id'])) {
    header('Location: ../Controlador/index.php');
}

modificarIdArticle($_GET['id'], $_SESSION['userID']);
deleteUsuari($_GET['id']);
$_SESSION['adminMsg'] = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>USUARI ELIMINAT CORRECTAMENT!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
header('Location: ../Controlador/admin.php');

?>