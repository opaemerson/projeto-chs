<?php

    $host = "localhost";
    $user = "root";
    $password= "";
    $dbname= "chs";

    $conn = new mysqli($host, $user, $password, $dbname);

    if($conn->connect_error){
        die("Conexão Falha".$conn->connect_error);
    }
?>