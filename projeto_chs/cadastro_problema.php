<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../config.php');

$nomeProblema = $_POST['nomeProblema'];

if(isset($nomeProblema) && $nomeProblema !== ''){ 
    $problemaExistente = "SELECT * FROM problema WHERE nome = '$nomeProblema'";
    $resultado = $conn->query($problemaExistente);

    if ($resultado->num_rows > 0){
        echo json_encode(['erro' => 1,'mensagem' => "Ja existe este nome!"]);
    } else{
        $sql = "INSERT INTO problema (nome) VALUES ('".$nomeProblema."')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['erro' => 0,'mensagem' => "Inserido!"]);
        } else {
            echo json_encode(['erro' => 1,'mensagem' => "Erro ao inserir"]);
        }
    }
}

$conn->close();
?>