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
    $cita = ($con->query("SELECT * FROM cita C INNER JOIN usuario U
    ON C.id_usuario = U.id_usuario WHERE id_cita = $id"))->fetch_assoc();

    if (!$cita)
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
    <title>Alcaldía de Los Taques | Revisar Cita</title>
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
            <a href="#" data-target="mobile-demo" class="sidenav-trigger right"><i class="fas fa-bars"></i></a>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a>Bienvenido <?php echo $_SESSION["nombre"] ?></a></li>
        <li><a href="lista.php">Revisar Citas</a></li>
        <li><a href="lista_usuarios.php">Ver usuarios</a></li>
        <li><a href="logica/logout.php">Salir</a></li>
    </ul>
    <div class="row contenedor" style="margin-bottom: 80px;">
        <div class="col s12 m4">
            <img src="img/logo.png" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 center">
            <img src="img/agenda.png" height="250px" width="250px" class="responsive-img" alt="">
            <h5 class="title">Detalles de la cita</h5>
        </div>
        <div class="col s12 m4 hide-on-med-and-down"></div>
    </div>

    <div class="row info-usuario">
        <div class="col s12 m6">
            <div class="row center">
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $cita["nombre"] ?>" class="input-registro">
                </div>
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $cita["cedula"] ?>" class="input-registro">
                </div>
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $cita["email"] ?>" class="input-registro">
                </div>
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $cita["direccion"] ?>" class="input-registro">
                </div>
                <div class="col s12">
                    <a class="boton-regular" href="ver_usuario.php?id=<?php echo $cita["id_usuario"] ?>">Ver usuario</a>
                </div>
            </div>
        </div>
        <div class="col s12 m6">
            <div class="row center">
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $cita["fecha"] ?>" class="input-registro">
                </div>
                <div class="col s12">
                    <input type="text" disabled value="<?php echo $cita["hora"] ?>" class="input-registro">
                </div>
                <div class="col s12">
                    <input type="text" disabled value="<?php if($cita["atendido"])echo 'Atendida'; else echo 'En proceso'; ?>" class="input-registro">
                </div>
                <div class="col s12">
                    <textarea disabled class="input-registro materialize-textarea" ><?php echo $cita["motivo"] ?></textarea>
                </div>
            </div>
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

        $("#formAdministrador").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'logica/designar_super.php',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok" || response.substring(0, 15) == "<!DOCTYPE html>") {
                        location.href = ""
                    } else {
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                    }
                }
            });
        })
    </script>
</body>

</html>