<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/vendor/autoload.php';
require_once '../Model/usuaris.php';

function generateToken($length = 32) {
    return bin2hex(random_bytes($length));
}

function enviarMail($correu){
    $token = generateToken();
    
    $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com;';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'm.garcia5@sapalomera.cat';
            $mail->Password   = 'fjjk yoly hnar reou';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
         
            $mail->setFrom('m.garcia5@sapalomera.cat', 'Marc');
            $mail->addAddress($correu);
            
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body    = "<html>
            <head>
                <title>Recuperació de contrasenya</title>
            </head>
            <body>
                <p>Hola,</p>
                <p>Fes clic a l'enllaç de sota per restablir la teva contrasenya:</p>
                <p><a href='https://xampp.garc.pro/www/practiques/UF1/Practica%205/Practica-5/Vistes/changeforgotpasswd.view.php?token=$token'>Restablir contrasenya</a></p>
                <p>Si no has sol·licitat un canvi de contrasenya, si us plau ignora aquest correu.</p>
                <p>Gràcies,</p>
                <p>L'equip de suport</p>
            </body>
            </html>";
            $mail->AltBody = "Hola,\n\nHem rebut una sol·licitud per restablir la teva contrasenya. Fes clic a l'enllaç de sota per restablir la teva contrasenya:\n\nhttps://xampp.garc.pro/www/practiques/UF1/Practica%205/Practica-5/Vistes/changepasswd.view.php?token=$token\n\nSi no has sol·licitat un canvi de contrasenya, si us plau ignora aquest correu.\n\nGràcies,\n\nL'equip de suport";
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        inserirToken($correu, $token);
        //Mostrem el missatge
        $_SESSION['forgotMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-warning' role='alert'>REVISA EL TEU CORREU<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/forgotpasswd.view.php");
    }

if(isset($_POST['forgotEmail'])){
    if (!getUsuari($_POST['forgotEmail'])){
        $_SESSION['forgotMsg'] = "<br><div class='alertes'><div class='alerta z-3 text-end alert alert-danger' role='alert'>ERROR - AQUEST CORREU NO EXISTEIX!!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        header("Location: ../Vistes/forgotpasswd.view.php");
    } else{
        enviarMail($_POST['forgotEmail']);
    }
}
    
?>