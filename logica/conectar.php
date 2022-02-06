<?php
if(isset($token))
    $con = new mysqli("localhost","root","","sistema_citas");
else 
    header("Location: ../error.php");