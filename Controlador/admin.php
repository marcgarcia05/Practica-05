<?php
session_start();
include_once '../Model/usuaris.php';

if (!isset($_SESSION['userID'])) {
    header('Location: ../Vistes/login.view.php');
}

if ($_SESSION['admin'] != 1) {
    header('Location: ../Vistes/index.view.php');
}

if (!isset($_SESSION['taula'])) {
    header('Location: ../Controlador/admin.php');
}

$resultats = getUsuaris();

if (count($resultats) > 0) {
    foreach ($resultats as $row) {
        if ($row['admin'] == 1) {
            $taula .= "<tr>\n<td>" . $row['ID'] . "</td>\n<td>" . $row['Nom_usuari'] . "</td>\n<td>" . $row['Email'] . "</td>\n<td><button class='btn btn-warning mx-3' readonly><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-ban' viewBox='0 0 16 16'>
  <path d='M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0'/>
</svg></button></td>\n</tr>\n";
        } else {
        $taula .= "<tr>\n<td>" . $row['ID'] . "</td>\n<td>" . $row['Nom_usuari'] . "</td>\n<td>" . $row['Email'] . "</td>\n<td><a href='../Controlador/deleteuser.php?id=" . $row['ID'] . "'><button type='submit' name='eliminar' class='btn btn-danger mx-3'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                </svg></button></td>\n</tr>\n";
        }
    }
} else {
    $taula = "<tr><td colspan='4'>No hi ha usuaris</td></tr>";
}
$_SESSION['taula'] = $taula;
header('Location: ../Vistes/admin.view.php');
?>

