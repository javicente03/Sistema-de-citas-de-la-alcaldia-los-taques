<?php
if(isset($_POST["token"])){
    $token = true;
    $id = $_POST["id"];
    if(is_numeric($id)){
        include("conectar.php");
        if($con->query("SELECT * FROM cita WHERE id_cita = $id AND atendido = false")->num_rows == 1){
            $con->query("UPDATE cita SET atendido = true WHERE id_cita = $id");
            echo "ok";
        } else
            echo "Operación inválidad";
    } else
        echo "Operación inválida";
} else
    header("Location: ../error.php");