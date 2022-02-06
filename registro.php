<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/materialize.min.css">
</head>

<body>
    <nav>
        <div class="nav-wrapper navcolor fixed">
            <div class="container">
                <a href="login.php" class="brand-logo texto-logo">Solicitudes</a>



                <ul class="right hide-on-med-and-down">
                    <li><a href="login.php">Iniciar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row contenedor">
        <div class="col s12 m4">
            <img src="img/logo.png" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 center">
            <img src="img/usuarios.png" height="250px" width="250px" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 hide-on-med-and-down"></div>
    </div>
    <div class="contenedor-center">
        <div class="row center">
            <form action="">

                <h4>Registro de Usuario</h4>
                <div class="col s12">
                    <input type="text" class="input-registro" placeholder="Nombre completo">
                </div>
                <div class="col s12">
                    <input type="text" class="input-registro" placeholder="Cédula">
                </div>
                <div class="col s12">
                    <input type="text" class="input-registro" placeholder="Correo Electrónico">
                </div>
                <div class="col s12">
                    <input type="password" class="input-registro" placeholder="Contraseña">
                </div>
                <div class="col s12">
                    <input type="password" class="input-registro" placeholder="Por favor confirme su contraseña">
                </div>
                <div class="col s12">
                    <select name="" id="">
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>

                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>
                        <option value="">Seleccione su lugar de residencia</option>

                    </select>
                </div>
                <div class="col s12 center">
                    <button>Registrar Usuario</button>
                </div>
                <a href="login.php" style="color: black;font-weight: bold;">¿Ya estás registrado? Inicia Sesión</a>
            </form>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/elementos_materialize.js"></script>
</body>

</html>