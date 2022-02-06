<?php 
    session_start();
    if(isset($_SESSION["id"]))
        header("Location: cita.php");
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
            <img src="img/persona.png" height="250px" width="250px" class="responsive-img" alt="">
        </div>
        <div class="col s12 m4 hide-on-med-and-down"></div>
    </div>
    <div class="contenedor-center">
        <div class="row center">
            <form id="form">
                <div class="col s12">
                    <input type="text" name="token" class="input-registro" placeholder="Ingrese el código de seguridad">
                </div>
                <div class="col s12">
                    <input type="password" name="password" class="input-registro" placeholder="Ingrese su nueva contraseña">
                </div>
                <div class="col s12">
                    <input type="password" name="confirm" class="input-registro" placeholder="Confirme su contraseña">
                </div>
                <div class="col s12 center">
                    <button id="btn-submit">Validar</button>
                    <div class="progress indigo darken-4" id="progress" style="display: none;">
                        <div class="indeterminate"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>

    <script>
        $('#form').submit(function(e) {
            $("#progress").css("display", "block")
            $("#btn-submit").prop("disabled", true)
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'logica/resetear_password.php',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok") {
                        M.toast({
                            html: 'Su contraseña ha sido reestablecida',
                            classes: 'rounded green'
                        })
                        setTimeout(() => {
                            location.href = "login.php"
                        }, 3000);
                    } else {
                        M.toast({
                            html: response,
                            classes: 'rounded red'
                        })
                        $("#progress").css("display", "none")
                        $("#btn-submit").prop("disabled", false)
                    }
                }
            });
        });
    </script>
</body>

</html>