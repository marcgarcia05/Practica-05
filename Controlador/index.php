<?php
include 'mostrar.php';
session_start();

if (!isset($_POST['search']) || empty($_POST['search'])) {
    if (isset($_GET['page'])) {
        $paginaActual = (int)$_GET['page'];
        if ($paginaActual == 0) {
            $paginaActual = 1;
        }
    } else {
        $paginaActual = 1;
    }
    if (isset($_GET['rpp'])) {
        $rpp = (int)$_GET['rpp'];
    } else {
        $rpp = 5;
    }
    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
    } else {
        $filter = 'data';
    }
    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    } else {
        $order = 'asc';
    }
    mostrar($paginaActual, $rpp, $order, $filter);
} else{
    if (isset($_GET['page'])) {
        $paginaActual = (int)$_GET['page'];
        if ($paginaActual == 0) {
            $paginaActual = 1;
        }
    } else {
        $paginaActual = 1;
    }
    if (isset($_GET['rpp'])) {
        $rpp = (int)$_GET['rpp'];
    } else {
        $rpp = 5;
    }
    if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
    } else {
        $filter = 'data';
    }
    if (isset($_GET['order'])) {
        $order = $_GET['order'];
    } else {
        $order = 'asc';
    }
    buscar($paginaActual, $rpp, $order, $filter, $_POST['search']);
}


