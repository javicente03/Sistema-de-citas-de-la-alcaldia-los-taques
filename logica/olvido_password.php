<?php
if(isset($_POST["token"])){
    $token = true;
    $email = trim(addslashes($_POST['email']));
    if($email != ""){
        include("validaciones.php");
        $validar = validar_email($email);
        if($validar){
            include("conectar.php");
            $sql = "SELECT * FROM usuario WHERE email = '$email'";
            $proceso = $con->query($sql);
            if($data = $proceso->fetch_assoc()){
                $hoy = date('Y-m-d');
                $code = bin2hex(random_bytes(5));
                $id = $data['id_usuario'];
                $borra = "DELETE FROM reset_password WHERE user_reset = $id";
                $borrar = $con->query($borra);
                $sql1 = "INSERT INTO reset_password (user_reset,token,fecha_reset) VALUES ('$id','$code','$hoy')";
                $proceso1 = $con->query($sql1);
                $asunto = "Alcaldia de Los Taques Resetee su contrasena";
                include("email/enviar-mail.php");
                $sendMail = sendMail($email,$asunto,0,0,$code);
                if($sendMail)
                    echo "ok";
            } else {
                echo "Correo no registrado";
            }
        } else {
            echo "Email inválido";
        }
    } else {
        echo "Debe ingresar un email";
    }   
} else {
    header("Location: ../404");
}