<?php
require_once 'connexio.php';

function inserirUsuari($nom, $email, $password) {
    global $connexio;
    $preparacio = $connexio->prepare("INSERT INTO usuaris (Nom_usuari, Contrasenya, Email) VALUES (:Nom_usuari, :Contrasenya, :Email);");
    $preparacio->execute([':Nom_usuari' => $nom, ':Contrasenya' => $password, 'Email' => $email]);
}

function inserirUsuariGoogle($nom, $email) {
    global $connexio;
    $preparacio = $connexio->prepare("INSERT INTO usuaris (Nom_usuari, Email, Google) VALUES (:Nom_usuari, :Email, :Google);");
    $preparacio->execute([':Nom_usuari' => $nom, 'Email' => $email, ':Google' => 1]);
}

function inserirUsuariGithub($nom, $email) {
    global $connexio;
    $preparacio = $connexio->prepare("INSERT INTO usuaris (Nom_usuari, Email, Github) VALUES (:Nom_usuari, :Email, :Github);");
    $preparacio->execute([':Nom_usuari' => $nom, 'Email' => $email, ':Github' => 1]);
}

function getUsuaris(){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM usuaris;");
    $preparacio->execute();
    $resultatSelect = $preparacio->fetchAll(PDO::FETCH_ASSOC);
    return $resultatSelect;
}

function comprovarUsuari($email){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT COUNT(*) FROM usuaris WHERE Email = ?");
    $preparacio->bindParam(1, $email);
    $preparacio->execute();
    $resultatSelect = $preparacio->fetchAll();
    return $resultatSelect;
}

function getUsuari($email){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM usuaris WHERE Email = ?");
    $preparacio->bindParam(1, $email);
    $preparacio->execute();
    $resultatSelect = $preparacio->fetch(PDO::FETCH_ASSOC);
    return $resultatSelect;
}

function getUsuariByID($id){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM usuaris WHERE ID = ?");
    $preparacio->bindParam(1, $id);
    $preparacio->execute();
    $resultatSelect = $preparacio->fetch(PDO::FETCH_ASSOC);
    return $resultatSelect;
}

function getPasswd($id){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT Contrasenya FROM usuaris WHERE ID = ?");
    $preparacio->bindParam(1, $id);
    $preparacio->execute();
    $resultatSelect = $preparacio->fetch(PDO::FETCH_ASSOC);
    return $resultatSelect;
}

function getUserByToken($token){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM usuaris WHERE Token = ?");
    $preparacio->bindParam(1, $token);
    $preparacio->execute();
    $resultatSelect = $preparacio->fetch(PDO::FETCH_ASSOC);
    return $resultatSelect;
}

function updatePasswd($id, $passwd){
    global $connexio;
    $preparacio = $connexio->prepare("UPDATE usuaris SET Contrasenya=:passwd WHERE ID=:id;");
    $preparacio->execute([':id' => $id, ':passwd' => $passwd]);
}

function updatePasswdByToken($token, $newpasswd){
    global $connexio;
    $preparacio = $connexio->prepare("UPDATE usuaris SET Contrasenya=:passwd WHERE Token=:token;");
    $preparacio->execute([':token' => $token, ':passwd' => $newpasswd]);
}

function updateProfile($id, $nom){
    global $connexio;
    $preparacio = $connexio->prepare("UPDATE usuaris SET Nom_usuari=:nom WHERE ID=:id;");
    $preparacio->execute([':id' => $id, ':nom' => $nom]);
}

function inserirToken($email, $token) {
    global $connexio;
    $preparacio = $connexio->prepare("UPDATE `usuaris` SET `Token` = :Token WHERE `Email` = :email;");
    $preparacio->execute([':Token' => $token, ':email' => $email]);
}

function deleteToken($token){
    global $connexio;
    $preparacio = $connexio->prepare("UPDATE `usuaris` SET `Token` = NULL WHERE `Token` = :Token;");
    $preparacio->execute([':Token' => $token]);
}

function deleteUsuari($id){
    global $connexio;
    $preparacio = $connexio->prepare("DELETE FROM usuaris WHERE ID=:id;");
    $preparacio->execute([':id' => $id]);
}

?>