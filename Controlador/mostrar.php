<?php
require_once '../Model/articles.php';

function mostrar($paginaActual, $rpp, $order, $filter){
    session_start();

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $totalArticulos = obtenirTotalArticlesUsuari($userID);
    } else{
        $totalArticulos = obtenirTotalArticles();
    }
    
    $totalPaginas = ceil($totalArticulos / $rpp);
    //Si la pàgina que ens han passat és més gran que l'última pàgina que tenim disponible mostrarem la pàgina 1
    if ($paginaActual > $totalPaginas) {
        $paginaActual = 1;
    }

    $offset = ($paginaActual - 1) * $rpp;

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION['userID'];
        $resultats = obtenirArticlesUsuariPaginats($offset, $rpp, $userID, $filter, $order);
    } else{
        $resultats = obtenirArticlesPaginats($offset, $rpp, $filter, $order);
    }

    //Comprovem que hi han productes
    if (count($resultats) > 0) {
        $missatge =  "<div class='container text-center position-flex'>\n<div class='row row-cols-3 mx-auto'>\n";
        //Generem els productes
        if(isset($_SESSION['userID'])){
            foreach ($resultats as $row) {
                $missatge .= "<div class='col mt-3'><div class='card' style='width: 18rem;'>\n<div class='card-body'>\n
                                <h5 class='card-title'>" .  $row['Titol'] . "</h5>\n<p class='card-text'>" . $row['Cos'] . "</p>\n
                                \n<form action='#' method='post'>
                                <button formAction='../Controlador/modificar.php' type='submit' name='mostrarModificar' value='" . $row['ID'] . "' class='btn btn-warning'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                                </svg></button>
                                <button formAction='../Controlador/eliminar.php' type='submit' name='eliminar' value='" . $row['ID'] . "' class='btn btn-danger mx-1'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                    <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                                </svg></button></form></div>\n</div>\n</div>\n";
            }
        } else{
            foreach ($resultats as $row) {
                $missatge .= "<div class='col mt-3'><div class='card' style='width: 18rem;'>\n<div class='card-body'>\n
                                <h5 class='card-title'>" .  $row['Titol'] . "</h5>\n<p class='card-text'>" . $row['Cos'] . "</p>\n
                                \n</div>\n</div>\n</div>\n";
            }
        }        
        $missatge .= "</div>\n</div>";
        $paginacio = "";
        //Boto enrere
        $enrere = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-left-fill' viewBox='0 0 16 16'>
                    <path d='m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z'/></svg>";
        //Boto següent
        $seguent = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-right-fill' viewBox='0 0 16 16'>
                    <path d='m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/></svg>";
        //Mostrem fletxa enrere
        if ($paginaActual > 1) {
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=../Controlador/index.php?page=" . ($paginaActual - 1) . "&rpp=" . $rpp . "&filter=" . $filter . "&order=" . $order . ">" . $enrere . "</a>\n</li>";
        } else {
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>". $enrere ."</a>\n</li>";
        }
        //Generem els "botons" de les pàgines
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaActual) {
                $paginacio .= "<li class='page-item active' aria-current='page'>
                                    <a class='page-link' href='../Controlador/index.php?page=$i&rpp=$rpp&filter=$filter&order=$order'>$i</a></li>";
            } else {
                $paginacio .= "<li class='page-item'><a class='page-link' href='../Controlador/index.php?page=$i&rpp=$rpp&filter=$filter&order=$order'>$i</a></li>";
            }
        }

        //Mostrem fletxa endavant
        if ($paginaActual < $totalPaginas) {
            $paginacio .= "<li class='page-item'>\n<a class='page-link' href=../Controlador/index.php?page=" . ($paginaActual + 1) . "&rpp=" . $rpp . "&filter=" . $filter . "&order=" . $order . ">" . $seguent . "</a>\n</li>";
        } else {
            $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>". $seguent ."</a>\n</li>";
        }

        $app = "<div class='dropdown d-flex mx-3'>
            <p>Articles per pagina</p>
                <button class='btn btn-primary dropdown-toggle mx-2' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                <span id='selectedOption'>" . $rpp . "</span>
                </button>
                <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                    <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=5&filter=$filter&order=$order'>5</a></li>
                    <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=10&filter=$filter&order=$order'>10</a></li>
                    <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=15&filter=$filter&order=$order'>15</a></li>
                </ul>
            </div>";

        $mostrarOrdre="<div class='dropdown d-flex mx-3 mt-1'>
            <p>Order By</p>
                <button class='btn btn-primary dropdown-toggle mx-2' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                <span id='selectedOption'>". ucfirst($filter) . " (" . strtoupper($order) . ")</span>
                </button>
                <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                    <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=". $rpp ."&filter=data&order=asc'>Data (ASC)</a></li>
                    <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=". $rpp ."&filter=data&order=desc'>Data (DESC)</a></li>
                    <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=". $rpp ."&filter=alphabetical&order=asc'>Alphabetical (ASC)</a></li>
                    <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=". $rpp ."&filter=alphabetical&order=desc'>Alphabetical (DESC)</a></li>
                </ul>
            </div>";
        //Passem la taula a la Vista
        $_SESSION['orderBy'] = $mostrarOrdre;
        $_SESSION['rpp'] = $app;
        $_SESSION['articles'] = $missatge;
        $_SESSION['paginacio'] = $paginacio;
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
    } else {
        //Passem la taula a la Vista
        $_SESSION['articles'] = "<p>No tens cap producte disponible</p>";
        header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
    }

    header("Location: ../Vistes/index.view.php?page=$paginaActual");
}

function buscar($paginaActual, $rpp, $filter, $order, $search){
        session_start();
    
        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
            $totalArticulos = searchTotalArticlesUsuari($userID, $search);
        } else{
            $totalArticulos = searchTotalArticles($search);
        }
        
        $totalPaginas = ceil($totalArticulos / $rpp);
        //Si la pàgina que ens han passat és més gran que l'última pàgina que tenim disponible mostrarem la pàgina 1
        if ($paginaActual > $totalPaginas) {
            $paginaActual = 1;
        }
    
        $offset = ($paginaActual - 1) * $rpp;
    
        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION['userID'];
            $resultats = searchArticlesUsuariPaginats($offset, $rpp, $userID, $filter, $order, $search);
        } else{
            $resultats = searchArticlesPaginats($offset, $rpp, $filter, $order, $search);
        }
    
        //Comprovem que hi han productes
        if (count($resultats) > 0) {
            $missatge =  "<div class='container text-center position-flex'>\n<div class='row row-cols-3 mx-auto'>\n";
            //Generem els productes
            foreach ($resultats as $row) {
                $missatge .= "<div class='col mt-3'><div class='card' style='width: 18rem;'>\n<div class='card-body'>\n
                                <h5 class='card-title'>" .  $row['Titol'] . "</h5>\n<p class='card-text'>" . $row['Cos'] . "</p>\n
                                \n</div>\n</div>\n</div>\n";
            }
            $missatge .= "</div>\n</div>";
    
            $paginacio = "";
            //Boto enrere
            $enrere = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-left-fill' viewBox='0 0 16 16'>
                        <path d='m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z'/></svg>";
            //Boto següent
            $seguent = "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-caret-right-fill' viewBox='0 0 16 16'>
                        <path d='m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z'/></svg>";
            //Mostrem fletxa enrere
            if ($paginaActual > 1) {
                $paginacio .= "<li class='page-item'>\n<a class='page-link' href=../Controlador/index.php?page=" . ($paginaActual - 1) . "&rpp=" . $rpp . "&filter=" . $filter . "&order=" . $order . ">" . $enrere . "</a>\n</li>";
            } else {
                $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>". $enrere ."</a>\n</li>";
            }
            //Generem els "botons" de les pàgines
            for ($i = 1; $i <= $totalPaginas; $i++) {
                if ($i == $paginaActual) {
                    $paginacio .= "<li class='page-item active' aria-current='page'>
                                        <a class='page-link' href='../Controlador/index.php?page=$i&rpp=$rpp&filter=$filter&order=$order'>$i</a></li>";
                } else {
                    $paginacio .= "<li class='page-item'><a class='page-link' href='../Controlador/index.php?page=$i&rpp=$rpp&filter=$filter&order=$order'>$i</a></li>";
                }
            }
    
            //Mostrem fletxa endavant
            if ($paginaActual < $totalPaginas) {
                $paginacio .= "<li class='page-item'>\n<a class='page-link' href=../Controlador/index.php?page=" . ($paginaActual + 1) . "&rpp=" . $rpp . "&filter=" . $filter . "&order=" . $order . ">" . $seguent . "</a>\n</li>";
            } else {
                $paginacio .= "<li class='page-item disabled'>\n<a class='page-link'>". $seguent ."</a>\n</li>";
            }
    
            $app = "<div class='dropdown d-flex mx-3'>
                <p>Articles per pagina</p>
                    <button class='btn btn-primary dropdown-toggle mx-2' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                    <span id='selectedOption'>" . $rpp . "</span>
                    </button>
                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                        <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=5&filter=$filter&order=$order'>5</a></li>
                        <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=10&filter=$filter&order=$order'>10</a></li>
                        <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=15&filter=$filter&order=$order'>15</a></li>
                    </ul>
                </div>";
    
            $mostrarOrdre="<div class='dropdown d-flex mx-3 mt-1'>
                <p>Order By</p>
                    <button class='btn btn-primary dropdown-toggle mx-2' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                    <span id='selectedOption'>". ucfirst($filter) . " (" . strtoupper($order) . ")</span>
                    </button>
                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                        <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=". $rpp ."&filter=data&order=asc'>Data (ASC)</a></li>
                        <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=". $rpp ."&filter=data&order=desc'>Data (DESC)</a></li>
                        <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=". $rpp ."&filter=alphabetical&order=asc'>Alphabetical (ASC)</a></li>
                        <li><a class='dropdown-item' href='../Controlador/index.php?page=1&rpp=". $rpp ."&filter=alphabetical&order=desc'>Alphabetical (DESC)</a></li>
                    </ul>
                </div>";
            //Passem la taula a la Vista
            $_SESSION['orderBy'] = $mostrarOrdre;
            $_SESSION['rpp'] = $app;
            $_SESSION['articles'] = $missatge;
            $_SESSION['paginacio'] = $paginacio;
            header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
        } else {
            //Passem la taula a la Vista
            $_SESSION['articles'] = "<p>No tens cap producte disponible</p>";
            header("Location: ../Vistes/index.view.php?page=" . $paginaActual);
        }
    
        header("Location: ../Vistes/index.view.php?page=$paginaActual");
    }

function tractarErrors($errors)
{
    $missatge = "<br><div class='alert alert-danger'>";
    foreach ($errors as $error) {
        $missatge .= "<p>$error</p>";
    }
    $missatge .= "</div>";
    return $missatge;
}

function mostrarMissatge($crud, $missatge)
{
    session_start();
    $_SESSION['missatge'] = $missatge;
    header("Location: ../Vistes/$crud.view.php");
}
