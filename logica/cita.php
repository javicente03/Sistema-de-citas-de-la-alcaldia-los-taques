<?php
if (isset($_POST["token"])) {
    $token = true;
    $fecha = trim(addslashes($_POST["fecha"]));

    include("validaciones.php");
    $fecha_valida = validar_fecha($fecha);
    if ($fecha_valida) {
        if ($fecha > date("Y-m-d")) {
            if (isset($_POST["hora"])) {
                $hora = trim(addslashes($_POST["hora"]));
                if ($hora == "08:00 am" || $hora == "09:00 am" ||
                    $hora == "10:00 am" || $hora == "11:00 am" || $hora == "12:00 pm") {

                    include("conectar.php");
                    session_start();
                    $con->query("INSERT INTO cita (id_usuario, fecha, hora) VALUES ('" . $_SESSION["id"] . "', '$fecha', '$hora')");
                    echo "ok";
                } else
                    echo "Debe seleccionar una hora válida";
            } else
                echo "Debe seleccionar una hora";
        } else
            echo "Debe seleccionar una fecha mayor a hoy";
    } else
        echo "Fecha inválida";
} else
    echo "../error.php";
