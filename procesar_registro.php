<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

/*----------------------------------MOSTRAR LOS ELEMENTOS (CONSULTA)--------------------------------------*/
if (isset($_POST['submit'])) {

    /*recibir los datos*/

    $nombre_us = $_POST["nombre_us"];
    $email_us = $_POST["email_us"];
    $contra_us = $_POST["contra_us"];
    $repContra_us = $_POST["repContra_us"];

    /*validacion de formulario*/
    $success = ''; //alerta de exito 
    $name_error = '';
    $email_error = '';
    $pass_error = '';
    $repass_error = '';

    if (empty($nombre_us)) {
        $name_error = 'Name is Required';
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $nombre_us)) {
            $name_error = 'Only Letters and White Space Allowed';
        }
    }

    if (empty($email_us)) {
        $email_error = 'Email is Required';
    } else {
        if (!filter_var($email_us, FILTER_VALIDATE_EMAIL)) {
            $email_error = 'eMail is invalid';
        }
    }

    if (empty($contra_us)) {
        $pass_error = 'Password is Required';
    } else {
        if ($contra_us != $repContra_us) {
            $pass_error = 'Passwords dont match';
        }
    }

    if (empty($repContra_us)) {
        $repass_error = 'Repeat password';
    } else {
        if ($contra_us != $repContra_us) {
            $repass_error = 'Passwords dont match';
        }
    }

    if ($name_error == '' && $email_error == '' && $pass_error == '' && $repass_error == '') {
        /*si todo esta bien enviarlos a la base de datos*/
        include_once "conexion.php";

        $vkey = md5(time() . $nombre_us); //generar vkey con el timepo actual y el nombre del usuario 
        $buenpass = password_hash($contra_us, PASSWORD_DEFAULT, ['cost' => 10]); //encriptar pass

        $sql_agregar = "INSERT INTO accounts (username, mi_password, email, vkey) VALUES (?,?,?,?)"; //signos de interrogacion por seguridad
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array($nombre_us, $buenpass, $email_us, $vkey)); //en el array van el el mismo orden que irian en los signos de interrogracion 

        if ($sentencia_agregar) { //si se agrega a la bd hacer esto 
            session_start();
            $_SESSION['success'] = "exito";

            //ENVIAR EL EMAIL 
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'TU EMAIL AQUI';                     //SMTP username
                $mail->Password   = 'TU PASSWORD AQUI';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('TU EMAIL AQUI', 'TaskTrackerTeam');
                $mail->addAddress($email_us);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Verificacion de tu cuenta de Task tracker';
                $mail->Body    = '<a href="http://localhost/NOSE/verify.php?vkey=' . $vkey . '">Activar Cuenta </a>';

                $mail->send();
                echo 'Message has been sent';
                echo $vkey;
                header("Location: thankyou.php");
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                //header("Location: index.php");
            }
            /* echo "datos agregados" . "<br>";
            echo "DATA:" . "<br>";
            echo $nombre_us . "<br>";
            echo $email_us . "<br>";
            echo $contra_us . "<br>";
            echo $repContra_us . "<br>";
            echo "ERRORS:" . "<br>";
            echo $name_error . "<br>";
            echo $email_error . "<br>";
            echo $pass_error . "<br>";
            echo $repass_error . "<br>";*/
        } else {
            echo "ERROR";
        }
    } else {
        header("location:index.php");
        echo "datos no agregados" . "<br>";
        echo "DATA:" . "<br>";
        echo $nombre_us . "<br>";
        echo $email_us . "<br>";
        echo $contra_us . "<br>";
        echo $repContra_us . "<br>";
        echo "ERRORS:" . "<br>";
        echo $name_error . "<br>";
        echo $email_error . "<br>";
        echo $pass_error . "<br>";
        echo $repass_error . "<br>";
        $_SESSION['success'] = null;
        $var_value = null;
        $sentencia_agregar = null;
        $pdo = null;
    }
} else {
    header("Location: index.php");
}
