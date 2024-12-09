<?php
//Si tenim la sessió iniciada mostrarem el navbar amb el boto de logout
if (isset($_SESSION['username'])) {
    if ($_SESSION['admin'] == 1){
        $admin = "<a class='dropdown-item' href='../Controlador/admin.php'>Admin</a>";
    } else {
        $admin = "";
    }
    if (isset($_SESSION['google']) && $_SESSION['google'] == 1 || isset($_SESSION['github']) && $_SESSION['github'] == 1){
        $passwd = "";
    } else {
        $passwd = "<a class='dropdown-item' href='../Vistes/changepasswd.view.php'>Change Password</a>";
        
    }
    echo "<nav class='navbar navbar-dark bg-primary'>
        <a class='navbar-brand mx-2' href='#'>Benvingut/da</a>
            <form action='../Controlador/index.php' method='post' class='form-inline justify-content-arround'>
            <div class='row'>
            <div class='col'>
            <input class='form-control mr-sm-1' type='search' placeholder='Search' id='search' name='search' aria-label='Search'>
            </div>
            <div class='col'>
            <button class='btn btn-warning' type='submit'>Search</button>
            </div>
            </div>
            </form>
        <div class='dropdown'>
            <button class='navbar-brand mx-6 nav-link dropdown-toggle list-unstyled' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                " . $_SESSION['username'] . "
            </button>
            <ul class='dropdown-menu position-absolute top-20 end-0' aria-labelledby='dropdownMenuButton'>
                " . $passwd . "
                <a class='dropdown-item' href='../Controlador/showprofile.php'>Editar Perfil</a>
                " . $admin ."
                <a class='dropdown-item' href='#'>...</a>
                <div class='dropdown-divider'></div>
                <a class='dropdown-item' href='../Controlador/logout.php'>Logout</a>
            </ul>
        </div>     
</nav>
<script src='https://code.jquery.com/jquery-3.5.1.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>";
    //Si no tenim la sessió iniciada mostrarem el navbar amb els botons de Login i Registre
} else {
    echo "<nav class='navbar navbar-dark bg-primary'>
    <a class='navbar-brand mx-2' href='#'>Pràctica 05</a>
    <form action='../Controlador/index.php' method='post' class='form-inline justify-content-arround'>
            <div class='row'>
            <div class='col'>
            <input class='form-control mr-sm-1' type='search' placeholder='Search' id='search' name='search' aria-label='Search'>
            </div>
            <div class='col'>
            <button class='btn btn-warning' type='submit'>Search</button>
            </div>
            </div>
            </form>
    <form action='#' method='post' class='form-inline justify-content-arround'>
        <button formAction='../Vistes/login.view.php' class='btn btn-outline-light mx-2' type='submit' name='login' value='signin'>Login</button>
        <button formAction='../Vistes/signup.view.php' class='btn btn-outline-light mx-2' type='submit' name='signup' value='signup'>Registrar-se</button>
    </form>
</nav>";
}
