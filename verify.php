<?php
$error = 0;

if (isset($_GET['vkey'])) {
    //echo "PROCESS";
    $vkey = $_GET['vkey'];
    //echo $vkey;  
    include_once "conexion.php";
    $sql_leer = "SELECT verified,vkey FROM accounts WHERE vkey = '$vkey' AND verified=0"; //signos de interrogacion por seguridad
    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute();
    $resultado = $gsent->fetchAll(); //obtener un array 
    //var_dump($resultado); //mostrar el array
    //print("<pre>" . print_r($resultado, true) . "</pre>");

    if ($resultado) {
        //var_dump($resultado); //mostrar el array
        //print("<pre>" . print_r($resultado, true) . "</pre>");
        $verificado;
        $mivkey;
        foreach ($resultado as $array) {
            //echo '<br>'.$array[0];
            //echo '<br>'.$array[1];
            $verificado = $array[0];
            $mivkey = $array[1];
        }

        //echo $verificado . '<br>';
        //echo $mivkey . '<br>';
        if ($verificado == 0 && $mivkey) {
            // echo "VALIDAR EMAIL";
            $sql_editar = "UPDATE accounts SET verified=1 WHERE vkey=? AND verified = 0"; //los ? son por seguridad
            $sentencia_editar = $pdo->prepare($sql_editar);
            $sentencia_editar->execute(array($vkey)); //los campos deben corresponder a los simbolos de ?
            if ($sentencia_editar) {
                $error = 0;
            } else {
                $error = 3;
            }
        } else {
            $error = 2;
        }
    } else {
        $error = 2;
    }
} else {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificacion</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-8 text-center">


                <?php
                if ($error == 2) {
                ?>
                    <img src="./img/remove.png" alt="" class="w-50 mt-3">
                    <h5 class="mt-4"> <?php echo ("LA DIRECCION DE CORREO YA FUE VERIFICADA O LA CUENTA NO EXISTE"); ?></h5><a href="./index.php">Salir</a>


                <?php
                    die();
                } else if ($error == 3) {
                ?>
                    <img src="./img/remove.png" alt="" class="w-50 mt-3">
                    <h5 class="mt-4"> <?php echo ("OCURRIO UN ERROR DURANTE LA VERIFICACION"); ?></h5>
                    <a href="./index.php">Salir</a>

                <?php
                    die();
                } else if ($error == 0) {
                ?>
                    <img src="./img/checked.png" alt="" class="w-50 mt-3">
                    <h5 class="mt-4"> <?php echo "TU DIRECCION DE CORREO ELECTRONICO HA SIDO VERIFICADA CORRECTAMENTE, YA PUEDES INICIAR SESION";
                                        ?></h5>
                    <a href="./index.php">Salir</a>
                <?php
                    die();
                }
                ?>
            </div>
        </div>
    </div>

</body>
<script src="./js/bootstrap.bundle.min.js"></script>

</html>

<?php
/*cerrar la conexion*/
$error = 0;
$sql_leer = null;
$gsent = null;
$resultado = null;
$pdo = null;
?>