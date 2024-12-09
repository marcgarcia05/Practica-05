<?php
session_start();

if (!isset($_SESSION['userID'])) {
    header('Location: ../Vistes/login.view.php');
}

if ($_SESSION['admin'] != 1) {
    header('Location: ../Vistes/index.view.php');
}

if (!isset($_SESSION['taula'])) {
    header('Location: ../Controlador/admin.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Estils/login.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .table-rounded {
            border-radius: 12px;
            overflow: hidden;
            /* Para mantener el borde redondeado con el contenido */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="position-relative">
            <div class="position-absolute top-0 start-0">
                <a href="../Vistes/index.view.php"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                    </svg></a>
            </div>
        </div>
        <h2 class="mb-4 text-center">Admin</h2>
        <div class="table-responsive table-rounded border shadow-sm">
            <table class="table table-striped table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Esborrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_SESSION['taula'])) {
                        echo $_SESSION['taula'];
                        unset($_SESSION['taula']);
                    }
                    ?>
                </tbody>
            </table>
            <?php
                if (isset($_SESSION['adminMsg'])) {
                    echo $_SESSION['adminMsg'];
                    unset($_SESSION['adminMsg']);
                }
                ?>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>