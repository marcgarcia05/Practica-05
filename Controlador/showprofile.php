<?php
session_start();
include  "../Controlador/timeout.php";
include  "../Model/usuaris.php";

if (isset($_SESSION['userID'])) {
    $user = getUsuariByID($_SESSION['userID']);
    $_SESSION['nom'] = $user['Nom_usuari'];
    $_SESSION['email'] = $user['Email'];
    header("Location: ../Vistes/editprofile.view.php");
} else {
    header("Location: ../Vistes/index.view.php");
}


?>
