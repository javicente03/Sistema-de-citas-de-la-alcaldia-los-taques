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
    <title>Sistema de Citas | Inicio de Sesión</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/materialize.min.css">
</head>

<body>
    <nav>
        <div class="nav-wrapper navcolor fixed">
            <div class="container">
                <a href="login.php" class="brand-logo texto-logo">Solicitudes</a>



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
            <form id="form">
                <input type="hidden" name="token" value="token">
                <div class="col s12">
                    <input type="email" class="input-registro" name="email" placeholder="Correo Electrónico">
                </div>
                <div class="col s12">
                    <input type="password" class="input-registro" name="password" placeholder="Contraseña">
                </div>
                <div class="col s12 center">
                    <button id="btn-submit">Iniciar Sesión</button>
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

    <script>
        $("#form").submit(function(e){
            $("#btn-submit").prop("disabled", true)
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'logica/login.php',
                data: $(this).serialize(),
                enctype: 'application/x-www-form-urlencoded',
                success: function(response) {
                    if (response == "ok") {
                        location.href = "cita.php"
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