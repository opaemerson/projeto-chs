<?php
    $host = "localhost";
    $user = "root";
    $password= "";
    $dbname= "gobinc";

    $conn = new mysqli($host, $user, $password, $dbname);

    if($conn->connect_error){
        die("Conexao Falha".$conn->connect_error);
    }
?>