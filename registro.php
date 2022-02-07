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
    <title>Alcaldía de Los Taques | Registro</title>
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
        <div class="col s12 m4">
            <p class="globo" style="height: initial;">La contraseña solo debe contener letras y números con una longitud de entre 8 y 12 caracteres</p>
        </div>
    </div>
    <div class="contenedor-center">
        <div class="row center">
            <form id="form">

                <h4>Registro de Usuario</h4>
                <div class="col s12">
                    <input type="text" name="nombre" class="input-registro" placeholder="Nombre completo">
                </div>
                <div class="col s12">
                    <input type="number" name="cedula" class="input-registro" placeholder="Cédula">
                </div>
                <div class="col s12">
                    <input type="email" name="email" class="input-registro" placeholder="Correo Electrónico">
                </div>
                <div class="col s12">
                    <input type="password" name="password" class="input-registro" placeholder="Contraseña">
                </div>
                <div class="col s12">
                    <input type="password" name="confirm" class="input-registro" placeholder="Por favor confirme su contraseña">
                </div>
                <div class="col s12">
                    <select name="direccion" id="direccion">
                        <option value="" selected disabled>Seleccione su comunidad</option>
                        <option value="Alí Primera">Alí Primera</option>
                        <option value="Amuay">Amuay</option>
                        <option value="Creolandia">Creolandia</option>
                        <option value="Cumajacoa">Cumajacoa</option>
                        <option value="El Hoyito">El Hoyito</option>
                        <option value="El Oasis">El Oasis</option>
                        <option value="El Tacal">El Tacal</option>
                        <option value="Guanadito">Guanadito</option>
                        <option value="Jayana">Jayana</option>
                        <option value="Judibana">Judibana</option>
                        <option value="Parque Residencial Nueva Jayana">Parque Residencial Nueva Jayana</option>
                        <option value="Santa Cruz de Los Taques">Santa Cruz de Los Taques</option>
                        <option value="Villa Marina">Villa Marina</option>
                    </select>
                </div>
                <div class="col s12 center">
                    <button id="btn-submit" type="submit">Registrar Usuario</button>
                </div>
                <input type="hidden" name="token" value="token">
                <a href="login.php" style="color: black;font-weight: bold;">¿Ya estás registrado? Inicia Sesión</a>
            </form>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/elementos_materialize.js"></script>

    <script>
        $("#form").submit(function(e){
            $("#btn-submit").prop("disabled", true)
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'logica/registro.php',
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