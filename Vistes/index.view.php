<?php
session_start();
require '../Controlador/timeout.php';
$paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if (!isset($_SESSION['articles'])) {
    header("Location: ../Controlador/index.php?page=" . $paginaActual);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estils/alertes.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    //Mostrem el Navbar
    include('navbar.view.php');
    //Mostrem el boto per inserir articles
    if (isset($_SESSION['username'])) {
        echo "<form action='../Vistes/inserir.view.php' method='post' class='form-inline justify-content-arround'>
            <button type='submit' name='inserir' class='btn btn-outline-success btn-lg mt-2 mx-2'>
            <svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' class='bi bi-plus-square' viewBox='0 0 16 16'>
                <path d='M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z'/>
                <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4'/>
            </svg>
            </button></form><br><h1 class='display-3 text-center'>Els teus articles</h1>";
    } else {
        echo "<br><h1 class='display-3 text-center'>Articles</h1>";
    }

    ?>
    <div class="mt-3 text-center">
        <?php
        //Mostrem els articles
        if (isset($_SESSION['articles'])) {
            echo $_SESSION['articles'];
            unset($_SESSION['articles']);
        }
        //Mostrem missatges
        if (isset($_SESSION['missatge'])) {
            echo $_SESSION['missatge'];
            unset($_SESSION['missatge']);
        }
        //Mostrem missatge de logout
        if (isset($_COOKIE['logout'])) {
            echo $_COOKIE['logout'];
        }
        ?>
    </div>
    <div class="mt-3 flex-bottom">
        <nav>
            <?php
            //Mostrem paginació
            if (isset($_SESSION['rpp'])) {
                echo $_SESSION['rpp'];
                unset($_SESSION['rpp']);
            }
            if (isset($_SESSION['orderBy'])) {
                echo $_SESSION['orderBy'];
                unset($_SESSION['orderBy']);
            }
            ?>
            
            <ul class="pagination justify-content-center">
                <?php
                //Mostrem paginació
                if (isset($_SESSION['paginacio'])) {
                    echo $_SESSION['paginacio'];
                    unset($_SESSION['paginacio']);
                }
                ?>
            </ul>
        </nav>
    </div>
</body>

</html>