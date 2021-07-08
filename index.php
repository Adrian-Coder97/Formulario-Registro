<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <title>Mi lista</title>
</head>

<body class="bg-dark text-white">
    <div class="container-fluid">
        <nav class="navbar navbar-light bg-dark text-white">
            <div class="container-fluid">
                <a class="text-decoration-none text-white" href="./"><img class="imagenLibro" src="./img/book.png" alt="">Mi Lista</a>
                <form method="POST" class="d-flex float-end needs-validation" novalidate>
                    <input class="form-control me-2" type="text" placeholder="Usuario" name="login_us" required>
                    <input class="form-control me-2" type="password" placeholder="Contraseña" name="passLogin_us" required>
                    <button class="btn btn-outline-success" type="submit">Login</button>
                </form>
            </div>
        </nav>
        <div class="row mt-2 d-flex justify-content-center">
            <div class="col-10 col-md-6 col-xxl-4 mt-4">
                <form method="POST" action="procesar_registro.php" class="form-control p-3 needs-validation" novalidate>
                    <h1 class="text-center">Registro</h1>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="nombre_us" name="nombre_us" required placeholder="Nombre de usuario">
                        <div class="valid-feedback">
                            Todo Bien!
                        </div>
                        <div id="usuario_invalido" class="invalid-feedback">
                            Ingresa tu nombre de usuario
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" id="email_us" name="email_us" required placeholder="Email">
                        <div class="valid-feedback">
                            Todo Bien!
                        </div>
                        <div id="email_invalido" class="invalid-feedback">
                            ingresa tu email
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="contra_us" name="contra_us" required placeholder="Contraseña">
                        <div class="valid-feedback">
                            Todo Bien!
                        </div>
                        <div id="contra_invalida" class="invalid-feedback">
                            ingresa tu contraseña
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="repContra_us" name="repContra_us" required placeholder="Repetir Contraseña">
                        <div class="valid-feedback">
                            Todo Bien!
                        </div>
                        <div id="recontra_invalida" class="invalid-feedback">
                            Repite tu contraseña
                        </div>
                    </div>

                    <div class="col-12">
                        <button id="boton_register" class="btn btn-primary w-100" type="submit">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/app.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>