<?php
/*----------------------------------MOSTRAR LOS ELEMENTOS (CONSULTA)--------------------------------------*/


if ($_POST) {
    include_once "conexion.php";
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
        /*enviarlos a la base de datos*/
        $sql_agregar = "INSERT INTO accounts (username, email, mi_password) VALUES (?,?,?)"; //signos de interrogacion por seguridad
        $sentencia_agregar = $pdo->prepare($sql_agregar);
        $sentencia_agregar->execute(array($nombre_us, $email_us, $contra_us)); //en el array van el el mismo orden que irian en los signos de interrogracion 
        session_start();

        $_SESSION['success'] = "exito";
        header("location:thankyou.php"); //recargar la pagina cuando se envien los datos 
        echo "datos agregados" . "<br>";
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
