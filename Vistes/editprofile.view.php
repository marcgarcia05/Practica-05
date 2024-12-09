<?php
session_start();
include  "../Controlador/timeout.php";
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
    //Mostrem navbar
    include('navbar.view.php');
    ?>
    <div class="position-relative">
        <div class="position-absolute top-0 start-0 mx-3 mt-3">
            <a href="../Vistes/index.view.php"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                    <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                </svg></a>
        </div>
    </div>
    <div class="container mt-5">
        <h1>Editar Perfil</h1>
        <br>
        <form action='../Controlador/editprofile.php' method='post' class='form-inline justify-content-arround'>
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id" name="id" value="<?php echo $_SESSION['userID']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $_SESSION['nom']; ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
            <?php
            //Mostrem missatge
            if (isset($_SESSION['perfil'])) {
                echo $_SESSION['perfil'];
                unset($_SESSION['perfil']);
            }
            ?>
        </form>
    </div>
</body>

</html>