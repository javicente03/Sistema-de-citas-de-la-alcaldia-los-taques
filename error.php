<?php
session_start();
if (!isset($_SESSION["id"]))
    header("Location: login.php");
else {
    if (!$_SESSION["permisos"])
        header("Location: cita.php");

    $token = true;
    include("logica/conectar.php");
    $citas = $con->query("SELECT * FROM cita C INNER JOIN usuario U
    ON C.id_usuario = U.id_usuario WHERE atendido = false ORDER BY fecha DESC");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alcaldía de Los Taques | Error</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="css/fontawesome-free-6.0.0-beta3-web/css/all.css" rel="stylesheet">
    <!--load all styles -->
</head>

<body>
    <nav>
        <div class="nav-wrapper navcolor fixed">
            <div class="container">
                <a href="lista.php" class="brand-logo texto-logo">Solicitudes</a>
                <ul class="right hide-on-med-and-down">
                    <li><a>Bienvenido <?php echo $_SESSION["nombre"] ?></a></li>
                    <li><a href="lista.php">Revisar Citas</a></li>
                    <li><a href="lista_usuarios.php">Ver usuarios</a></li>
                    <li><a href="logica/logout.php">Salir</a></li>
                </ul>
            </div>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i class="fas fa-bars"></i></a>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a>Bienvenido <?php echo $_SESSION["nombre"] ?></a></li>
        <?php if($_SESSION["permisos"]){ ?>
        <li><a href="lista.php">Revisar Citas</a></li>
        <li><a href="lista_usuarios.php">Ver usuarios</a></li>
        <?php } ?>
        <li><a href="logica/logout.php">Salir</a></li>
    </ul>
    <div class="row contenedor">
        <div class="col s12 m4">
            <img src="img/logo.png" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 center">
            <img src="img/error.png" height="250px" width="250px" class="responsive-img" alt="">
            <h5 class="title">404 Página no encontrada</h5>
        </div>
        <div class="col s12 m4 hide-on-med-and-down"></div>
    </div>
    
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
</body>

</html>