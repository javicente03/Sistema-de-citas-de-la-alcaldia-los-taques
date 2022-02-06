<?php
if (isset($_POST["token"])) {
    $token = true;
    $nombre = addslashes(trim($_POST["nombre"]));
    $password = addslashes(trim($_POST["password"]));
    $confirm = addslashes(trim($_POST["confirm"]));
    $cedula = addslashes(trim($_POST["cedula"]));
    $email = trim(addslashes($_POST['email']));


    if ($nombre != "" && $cedula != "" && $password != "" && $email != "") {
        if (is_numeric($cedula)) {
            if (isset($_POST["direccion"])) {
                $direccion = trim(addslashes($_POST["direccion"]));
                if ($direccion != "") {
                    include("validaciones.php");
                    $email_valido = validar_email($email);
                    if ($email_valido) {
                        if (strcmp($password, $confirm) === 0) {
                            if (preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,12}$/', $password)) {
                                include("conectar.php");
                                if (($con->query("SELECT * FROM usuario WHERE cedula = $cedula"))->num_rows == 0) {

                                    if (($con->query("SELECT * FROM usuario WHERE email = '$email'"))->num_rows == 0) {

                                        $opciones = [
                                            'cost' => 12,
                                        ];
                                        $hash = password_hash($password, PASSWORD_BCRYPT, $opciones);
                                        $con->query("INSERT INTO usuario (password,nombre,cedula,direccion,email)
                                                    VALUES ('$hash','$nombre','$cedula','$direccion','$email')");

                                        $user = ($con->query("SELECT * FROM usuario ORDER BY id_usuario DESC LIMIT 1"))->fetch_assoc();

                                        session_start();
                                        $_SESSION['id'] = $user['id_usuario'];
                                        $_SESSION['nombre'] = $user['nombre'];
                                        $_SESSION['cedula'] = $user['cedula'];
                                        $_SESSION['permisos'] = $user['super_usuario'];
                                        $_SESSION['direccion'] = $user['direccion'];
                                        $_SESSION['email'] = $user['email'];
                                        echo "ok";
                                    } else
                                        echo "Correo ya registrado";
                                } else
                                    echo "Cédula ya registrada";
                            } else
                                echo "La contraseña solo debe contener letras y números con una longitud de entre 8 y 12 caracteres";
                        } else
                            echo "Las contraseñas no coinciden";
                    } else
                        echo "Dirección de correo inválida";
                } else
                    echo "Debe seleccionar su dirección";
            } else
                echo "Debe seleccionar su dirección";
        } else
            echo "La cédula debe ser numérica";
    } else
        echo "Debe completar todos los datos correctamente";
} else
    header("Location: ../error.php");
