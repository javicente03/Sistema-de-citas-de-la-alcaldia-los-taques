<?php
if (isset($_POST["token"])) {
    $token = true;
    $email = addslashes(trim($_POST["email"]));
    $clave = addslashes(trim($_POST["password"]));

    if ($email != "" && $clave != "") {
        include("conectar.php");
        $user = ($con->query("SELECT * FROM usuario WHERE email = '$email'"))->fetch_assoc();
        if ($user) {
            if (password_verify($clave, $user['password'])) {
                session_start();
                $_SESSION['id'] = $user['id_usuario'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['cedula'] = $user['cedula'];
                $_SESSION['permisos'] = $user['super_usuario'];
                $_SESSION['direccion'] = $user['direccion'];
                $_SESSION['email'] = $user['email'];
                echo "ok";
            } else
                echo "Contraseña inválida";
        } else
            echo "Usuario no existente";
    } else
        echo "Debe completar los datos";
} else
    header("Location: ../error.php");
