<?php
session_start();
include '../Model/usuaris.php';

function modificarPasswdPerID($userID){
    $passwd = $_POST['passwd'];
    $passwdNew = $_POST['newPasswd'];
    $passwdNew2 = $_POST['newPasswdConf'];

    $passwd = htmlspecialchars($passwd);
    $passwdNew = htmlspecialchars($passwdNew);
    $passwdNew2 = htmlspecialchars($passwdNew2);

    $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
    if (empty($passwdNew)){
        $_SESSION['passwdMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - EL PASSWORD NO POT ESTAR BUIT!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changepasswd.view.php");
        return;
    } 
    if (empty($passwdNew2)){
        $_SESSION['passwdMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - EL PASSWORD NO POT ESTAR BUIT!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changepasswd.view.php");
        return;
    } 
    if (empty($passwd)){
        $_SESSION['passwdMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - EL PASSWORD NO POT ESTAR BUIT!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changepasswd.view.php");
        return;
    } 
    if($passwdNew != $passwdNew2){
        $_SESSION['passwdMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - LES CONTRASENYES NOVES NO COINCIDEIXEN!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changepasswd.view.php");
        return;
    } 
    if (preg_match($password_regex, $passwdNew) == 0) {
        $_SESSION['passwdMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - PASWORD MOLT DEBIL!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changepasswd.view.php");
        return;
    }
    
    $resultat = getPasswd($userID);
    if(password_verify($passwd, $resultat['Contrasenya'])){
        $hash = password_hash($passwdNew, PASSWORD_BCRYPT);
        updatePasswd($userID, $hash);
        $_SESSION['passwdMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-success' role='alert'>PASSWORD MODIFICAT CORRECTAMENT!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changepasswd.view.php");
    } else{
        $_SESSION['passwdMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - PASSWORD INCORRECTE!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changepasswd.view.php");
    }
    
}

function modificarPasswdPerToken($token){
    $passwdNew = $_POST['newPasswd'];
    $passwdNew2 = $_POST['newPasswdConf'];

    $passwdNew = htmlspecialchars($passwdNew);
    $passwdNew2 = htmlspecialchars($passwdNew2);

    $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
    if ($passwdNew == "" || $passwdNew2 == ""){
        $_SESSION['passwd'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - EL PASSWORD NO POT ESTAR BUIT!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changeforgotpasswd.view.php");
        return;
    } 
    if($passwdNew != $passwdNew2){
        $_SESSION['changeMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - LES CONTRASENYES NOVES NO COINCIDEIXEN!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changeforgotpasswd.view.php");
        return;
    } 
    if (preg_match($password_regex, $passwdNew) == 0) {
        $_SESSION['changeMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - PASWORD MOLT DEBIL!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changeforgotpasswd.view.php");
        return;
    }
    
    $resultat = getUserByToken($token);
    if($resultat != null){
        $hash = password_hash($passwdNew, PASSWORD_BCRYPT);
        updatePasswdByToken($token, $hash);
        deleteToken($token);
        $_SESSION['passwd'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-success' role='alert'>PASSWORD MODIFICAT CORRECTAMENT!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/login.view.php");
    } else{
        $_SESSION['changeMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - TOKEN INCORRECTE!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/changeforgotpasswd.view.php");
    }
    
}

if(isset($_POST['passwd']) && isset($_SESSION['userID'])){
    modificarPasswdPerID($_SESSION['userID']);
} else if(isset($_SESSION['token'])){
    modificarPasswdPerToken($_SESSION['token']);
} else{
}

?>