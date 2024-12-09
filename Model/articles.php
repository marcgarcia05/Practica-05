<?php
require_once 'connexio.php';

function inserirArticle($titol, $cos, $userID){
    global $connexio;
    $preparacio = $connexio->prepare("INSERT INTO articles (Titol, Cos, User_ID) VALUES (:titol, :cos, :userID);");
    $preparacio->execute([':titol' => $titol, ':cos' => $cos, ':userID' => $userID]);
}

function modificarArticle($id, $titol, $cos){
    global $connexio;
    $preparacio = $connexio->prepare("UPDATE articles SET Titol=:titol, Cos=:cos WHERE ID=:id;");
    $preparacio->execute([':id' => $id, ':titol' => $titol, ':cos' => $cos]);
}

function modificarIdArticle($id, $userID){
    global $connexio;
    $preparacio = $connexio->prepare("UPDATE articles SET User_ID=:userID WHERE User_ID=:id;");
    $preparacio->execute([':id' => $id, ':userID' => $userID]);
}

function eliminarArticle($id){
    global $connexio;
    $preparacio = $connexio->prepare("DELETE FROM articles WHERE id=:id;");
    $preparacio->execute([':id' => $id]);
}

function consultarArticle($id){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM articles WHERE id=:id;");
    $preparacio->execute([':id' => $id]);
    return $preparacio->fetch();
}

function obtenirArticlesPaginats($offset, $rpp, $filtre, $ordre){
    global $connexio;
    if ($filtre == 'alphabetical') {
        if ($ordre == 'desc') {
            $preparacio = $connexio->prepare("SELECT * FROM articles ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
    } else{
        $preparacio = $connexio->prepare("SELECT * FROM articles ORDER BY Titol ASC LIMIT :limit OFFSET :offset;");
    }
    } else if ($filtre == 'data') {
        if ($ordre == 'desc') {
            $preparacio = $connexio->prepare("SELECT * FROM articles ORDER BY ID DESC LIMIT :limit OFFSET :offset;");
        } else {
            $preparacio = $connexio->prepare("SELECT * FROM articles ORDER BY ID ASC LIMIT :limit OFFSET :offset;");
        }
    } else {
        $preparacio = $connexio->prepare("SELECT * FROM articles ORDER BY ID DESC LIMIT :limit OFFSET :offset;");
        }
    $preparacio->bindValue(':limit', $rpp, PDO::PARAM_INT);
    $preparacio->bindValue(':offset', $offset, PDO::PARAM_INT);
    $preparacio->execute();
    return $preparacio->fetchAll();
}

function searchArticlesPaginats($offset, $rpp, $filtre, $ordre, $search){
    global $connexio;
    if ($filtre == 'alphabetical') {
        if ($ordre == 'desc') {
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE Titol LIKE '%$search%' ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
    } else{
        $preparacio = $connexio->prepare("SELECT * FROM articles WHERE Titol LIKE '%$search%' ORDER BY Titol ASC LIMIT :limit OFFSET :offset;");
    }
    } else if ($filtre == 'data') {
        if ($ordre == 'desc') {
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE ID LIKE '%$search%' ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
        } else {
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE ID LIKE '%$search%' ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
        }
    } else {
        $preparacio = $connexio->prepare("SELECT * FROM articles WHERE Titol LIKE '%$search%' ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
        }
    $preparacio->bindValue(':limit', $rpp, PDO::PARAM_INT);
    $preparacio->bindValue(':offset', $offset, PDO::PARAM_INT);
    $preparacio->execute();
    return $preparacio->fetchAll();
}

function obtenirArticlesUsuariPaginats($offset, $rpp, $usuariID, $filtre, $ordre){
    global $connexio;
    if ($filtre == 'alphabetical') {
        if ($ordre == 'desc') {
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
    } else{
        $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID ORDER BY Titol ASC LIMIT :limit OFFSET :offset;");
    }
    } else if ($filtre == 'data') {
        if ($ordre == 'desc') {
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID ORDER BY ID DESC LIMIT :limit OFFSET :offset;");
        } else {
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID ORDER BY ID ASC LIMIT :limit OFFSET :offset;");
        }
    } else {
        $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID ORDER BY ID DESC LIMIT :limit OFFSET :offset;");
        }
    $preparacio->bindValue(':limit', $rpp, PDO::PARAM_INT);
    $preparacio->bindValue(':offset', $offset, PDO::PARAM_INT);
    $preparacio->execute();
    $resultat = $preparacio->fetchAll();
    return $resultat;
}

function searchArticlesUsuariPaginats($offset, $rpp, $usuariID, $filtre, $ordre, $search){
    global $connexio;
    if ($filtre == 'alphabetical') {
        if ($ordre == 'desc') {
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID AND Titol LIKE '%$search%' ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
    } else{
        $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID AND Titol LIKE '%$search%' ORDER BY Titol ASC LIMIT :limit OFFSET :offset;");
    }
    } else if ($filtre == 'data') {
        if ($ordre == 'desc') {
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID AND ID LIKE '%$search%' ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
        } else {
            $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID AND ID LIKE '%$search%' ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
        }
    } else {
        $preparacio = $connexio->prepare("SELECT * FROM articles WHERE User_ID=$usuariID AND Titol LIKE '%$search%' ORDER BY Titol DESC LIMIT :limit OFFSET :offset;");
        }
    $preparacio->bindValue(':limit', $rpp, PDO::PARAM_INT);
    $preparacio->bindValue(':offset', $offset, PDO::PARAM_INT);
    $preparacio->execute();
    $resultat = $preparacio->fetchAll();
    return $resultat;
}

function obtenirTotalArticles(){
    global $connexio;
    return $connexio->query("SELECT COUNT(*) FROM articles")->fetchColumn();
}

function searchTotalArticles($search){
    global $connexio;
    return $connexio->query("SELECT COUNT(*) FROM articles WHERE Titol LIKE '%$search%'")->fetchColumn();
}

function obtenirTotalArticlesUsuari($userID){
    global $connexio;
    return $connexio->query("SELECT COUNT(*) FROM articles WHERE User_ID=$userID")->fetchColumn();
}

function searchTotalArticlesUsuari($userID, $search){
    global $connexio;
    return $connexio->query("SELECT COUNT(*) FROM articles WHERE User_ID=$userID AND Titol LIKE '%$search%'")->fetchColumn();
}

function getArticle($nom){
    global $connexio;
    $preparacio = $connexio->prepare("SELECT * FROM articles WHERE Titol LIKE '%:titol%';");
    $preparacio->execute([':titol' => $nom]);
    $resultatSelect = $preparacio->fetch();
    return $resultatSelect;
}