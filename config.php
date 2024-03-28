<?php
    $host = "localhost";
    $user = "root";
    $password= "";
    $dbname= "gobinc";
    // $dbname= "chs_home";

    $conn = new mysqli($host, $user, $password, $dbname);

    if($conn->connect_error){
        die("Conexao Falha".$conn->connect_error);
    }
?>