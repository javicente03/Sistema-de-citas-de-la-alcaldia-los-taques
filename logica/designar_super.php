<?php
if (isset($_POST["token"])) {
    session_start();
    $token = true;
    $password = trim(addslashes($_POST["password"]));


    include("conectar.php");

    $administrador = ($con->query("SELECT * FROM usuario WHERE id_usuario = " . $_SESSION["id"]))->fetch_assoc();

    if (password_verify($password, $administrador["password"])) {

        $user = ($con->query("SELECT * FROM usuario WHERE id_usuario = " . $_POST["usuario_cargo"]))->fetch_assoc();

        if ($user) {

                if ($user["super_usuario"])
                    $con->query("UPDATE usuario SET super_usuario = false WHERE id_usuario = " . $_POST["usuario_cargo"]);
                else
                    $con->query("UPDATE usuario SET super_usuario = true WHERE id_usuario = " . $_POST["usuario_cargo"]);

                echo "ok";
        } else
            echo "Usuario no encontrado";
    } else
        echo "Debe ingresar su clave de seguridad";
} else
    header("Location: ../error.php");
