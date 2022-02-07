<?php 
    session_start();
    if(!isset($_SESSION["id"]))
        header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alcaldía de Los Taques | Agendar Cita</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link href="css/fontawesome-free-6.0.0-beta3-web/css/all.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="nav-wrapper navcolor fixed">
            <div class="container">
                <a href="cita.php" class="brand-logo texto-logo">Solicitudes</a>
                <ul class="right hide-on-med-and-down">
                    <li><a>Bienvenido <?php echo $_SESSION["nombre"] ?></a></li>
                    <?php if($_SESSION["permisos"]){ ?>
                    <li><a href="lista.php">Revisar Citas</a></li>
                    <li><a href="lista_usuarios.php">Ver usuarios</a></li>
                    <?php } ?>
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
            <h5 class="globo">Formulario de solicitud de citas</h5>
            <img src="img/calendario.png" height="250px" width="250px" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 hide-on-med-and-down"></div>
    </div>
    <div class="contenedor-center" style="margin-top: 0;">
        <div class="row center">
            <form id="form">
                <input type="hidden" name="token" value="token">
                <div class="col s12 m4">
                    <input class="input-registro" type="date" name="fecha" id="fecha">
                </div>
                <div class="col s12 m4">
                    <select name="hora" id="hora">
                        <option value="" disabled selected>Horarios Disponibles</option>
                        <option value="08:00 am">08:00 am</option>
                        <option value="09:00 am">09:00 am</option>
                        <option value="10:00 am">10:00 am</option>
                        <option value="11:00 am">11:00 am</option>
                        <option value="12:00 pm">12:00 pm</option>
                    </select>
                </div>
                <div class="col s12 m4">
                    <button type="submit" style="width: 100%;" id="btn-submit">Agendar Citas</button>
                </div>
                <div class="col s12 input-field">
                    <textarea name="motivo" data-length="500" id="motivo" placeholder="Por favor detalle el motivo de su solicitud" required class="input-registro materialize-textarea validate"></textarea>
                    <span class="helper-text" data-error="Este dato es requerido y no debe exceder los 500 caracteres" data-success=""></span>
                </div>
            </form>
        </div>
    </div>
    
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/elementos_materialize.js"></script>
    <script>
        $(document).ready(function() {
            $('#motivo').characterCounter();
        });

        $("#form").submit(function(e){
            $("#btn-submit").prop("disabled", true)
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'logica/cita.php',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok") {
                        M.toast({
                            html: "Cita agendada",
                            classes: 'rounded green'
                        })
                        $("#btn-submit").prop("disabled", false)
                        document.getElementById("form").reset()
                    } else {
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                        $("#btn-submit").prop("disabled", false)
                    }
                }
            });
        })
    </script>
</body>

</html>