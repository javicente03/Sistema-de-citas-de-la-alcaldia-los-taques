<?php
session_start();
if (!isset($_SESSION["id"]))
    header("Location: login.php");
else {
    if (!$_SESSION["permisos"])
        header("Location: cita.php");

    $id = $_GET["id"];

    if (!is_numeric($id))
        header("Location: error.php");

    $token = true;
    include("logica/conectar.php");
    $usuario = ($con->query("SELECT * FROM usuario WHERE id_usuario = $id"))->fetch_assoc();

    if (!$usuario)
        header("Location: error.php");

    $citas = $con->query("SELECT * FROM cita WHERE id_usuario = $id");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
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
        </div>
    </nav>
    <div class="row contenedor" style="margin-bottom: 80px;">
        <div class="col s12 m4">
            <img src="img/logo.png" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 center">
            <img src="img/persona.png" height="250px" width="250px" class="responsive-img" alt="">
            <h5 class="title">Citas solicitadas</h5>
        </div>
        <div class="col s12 m4 hide-on-med-and-down"></div>
    </div>

    <div class="row info-usuario">
        <div class="col s12 m6">
            <div class="row center">
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $usuario["nombre"] ?>" class="input-registro" placeholder="Nombre completo">
                </div>
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $usuario["cedula"] ?>" class="input-registro" placeholder="Cédula">
                </div>
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $usuario["email"] ?>" class="input-registro" placeholder="Correo Electrónico">
                </div>
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $usuario["direccion"] ?>" class="input-registro" placeholder="Contraseña">
                </div>
            </div>
        </div>
        <div class="col s12 m6 row citas" style="max-height: 200px;height: initial;margin-top: 0;">
            <?php while ($row = $citas->fetch_assoc()) { ?>
                <div class="col s12" id="globo<?php echo $row["id_cita"] ?>">
                    <p class="globo">
                            Día: <?php echo $row["fecha"] ?> | Hora: <?php echo $row["hora"] ?></p>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/elementos_materialize.js"></script>
    <script src="js/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable({
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No hay data encontrada",
                    "info": "Total: _MAX_ resultados",
                    "infoEmpty": "No hay coincidencias",
                    "infoFiltered": "",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
</body>

</html>