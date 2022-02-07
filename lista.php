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
    <title>Alcaldía de Los Taques | Citas Pendientes</title>
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
        <li><a href="lista.php">Revisar Citas</a></li>
        <li><a href="lista_usuarios.php">Ver usuarios</a></li>
        <li><a href="logica/logout.php">Salir</a></li>
    </ul>
    <div class="row contenedor">
        <div class="col s12 m4">
            <img src="img/logo.png" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 center">
            <h5 class="globo" style="margin-top: 50px;">Listado de citas</h5>
        </div>
        <div class="col s12 m4 center">
            <img src="img/agenda.png" height="250px" width="250px" class="responsive-img" alt="">
        </div>
    </div>

    <div id="contenedor" class="contenedor-center citas row" style="max-height: 350px;height: initial;">
        <?php while ($row = $citas->fetch_assoc()) { ?>
            <div class="col s12 m11" id="globo<?php echo $row["id_cita"] ?>" title="<?php echo $row["motivo"] ?>">
                <p class="globo"><a href="ver_cita.php?id=<?php echo $row["id_cita"] ?>" title="Ver detalle">
                        Nombre: <?php echo $row["nombre"] ?> | Día: <?php echo $row["fecha"] ?> | Hora: <?php echo $row["hora"] ?></a></p>
            </div>
            <div class="col s12 m1 center" id="boton<?php echo $row["id_cita"] ?>">
                <button class="check" onclick="marcar(<?php echo $row['id_cita']; ?>)" title="Marcar como atendido"><i class="fas fa-check"></i></button>
            </div>
        <?php } ?>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/elementos_materialize.js"></script>
    <script>
        function marcar(id) {
            var option = "¿Seguro desea proceder?"
            if (confirm(option)) {
                var formData = new FormData()
                formData.append('id', id)
                formData.append('token', 'token')
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'logica/marcar_atendido.php',
                    data: formData,
                    enctype: 'application/x-www-form-urlencoded',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == "ok") {
                            M.toast({
                                html: "Atendido",
                                classes: 'rounded green'
                            })
                            var globo = document.getElementById("globo" + id)
                            var boton = document.getElementById("boton" + id)
                            document.getElementById("contenedor").removeChild(globo)
                            document.getElementById("contenedor").removeChild(boton)
                        } else {
                            M.toast({
                                html: response,
                                classes: 'rounded red'
                            })
                        }
                    }
                });
            }
        }
    </script>
</body>

</html>