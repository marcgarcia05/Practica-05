<?php
session_start();
include  "../Controlador/timeout.php";
include  "../Model/usuaris.php";

if (isset($_POST['nom']) && isset($_POST['id'])) {
    updateProfile($_POST['id'], $_POST['nom']);
    $_SESSION['username'] = $_POST['nom'];
    $_SESSION['nom'] = $_POST['nom'];
    $_SESSION['perfil'] = "<div class='alertes alert alert-success d-flex align-items-center' role='alert'>Perfil actualitzat correctament<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>";
    header("Location: ../Vistes/editprofile.view.php");
} else {
    $_SESSION['perfil'] = "<div class='alertes alert alert-danger d-flex align-items-center' role='alert'>Error al actualitzar el perfil<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>";
    header("Location: ../Vistes/editprofile.view.php");
}

?>