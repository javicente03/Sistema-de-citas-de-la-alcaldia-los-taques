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
                <a href="registro.php" class="brand-logo texto-logo">Solicitudes</a>



                <ul class="right hide-on-med-and-down">
                    <li><a href="registro.php">Registrarse</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row contenedor">
        <div class="col s12 m4">
            <img src="img/logo.png" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 center">
            <img src="img/persona.png" height="250px" width="250px" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 hide-on-med-and-down"></div>
    </div>
    <div class="contenedor-center">
        <div class="row center">
            <form action="">
                <div class="col s12">
                    <input type="text" class="input-registro" placeholder="Correo Electrónico">
                </div>
                <div class="col s12">
                    <input type="password" class="input-registro" placeholder="Contraseña">
                </div>
                <div class="col s12 center">
                    <button>Iniciar Sesión</button>
                </div>
                <div class="col s12">
                    <a href="registro.php" style="color: black;font-weight: bold;">¿Aún no tienes cuenta? Regístrate</a>
                </div>
                <div class="col s12">
                    <a href="olvido_password.php" style="color: black;font-weight: bold;">¿Olvidó Su Contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
</body>

</html>