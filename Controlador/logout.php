<?php
session_start();
session_destroy();
setcookie("logout", "<div class='alertes alert alert-warning d-flex align-items-center' role='alert'>ATENCIÓ - SESSIÓ TANCADA CORRECTAMENT<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>", time() + 5);
header("Location: ../Controlador/index.php?page=1");
exit();
?>