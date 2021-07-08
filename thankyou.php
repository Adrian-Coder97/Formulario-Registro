<?php
session_start();
$var_value = $_SESSION['success'];
if ($var_value === "exito") {
    /*cerrar la conexion de agregar:*/
    $_SESSION['success'] = null;
    $var_value = null;
    $sentencia_agregar = null;
    $pdo = null;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SUCCESS!</title>
        <link rel="stylesheet" href="./css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-6 text-center">
                    <img class="w-50" src="./img/email.png" alt="">
                    <h1>Gracias por registrarte. Enviamos un Email de Verificacion a la direccion de Correo Electronico que proporcionaste.</h1>
                </div>
            </div>
        </div>
    </body>
    <script src="./js/bootstrap.bundle.min.js"></script>

    </html>

<?php
} else {
    header("Location: index.php");
    /*cerrar la conexion de agregar:*/
    $sentencia_agregar = null;
    $pdo = null;
}
?>