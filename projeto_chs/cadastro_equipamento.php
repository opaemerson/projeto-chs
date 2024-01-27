<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../config.php');

$nomeEquipamento = $_POST['nomeEquipamento'];

if(isset($nomeEquipamento) && $nomeEquipamento !== ''){ 
    $queryExistente = "SELECT * FROM chs_equipamento WHERE nome = '$nomeEquipamento'";
    $resultado = $conn->query($queryExistente);

    if ($resultado->num_rows > 0){
        echo json_encode(['erro' => 1,'mensagem' => "Ja existe este nome!"]);
    } else{
        $sql = "INSERT INTO chs_equipamento (nome) VALUES ('".$nomeEquipamento."')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['erro' => 0,'mensagem' => "Inserido!"]);
        } else {
            echo json_encode(['erro' => 1,'mensagem' => "Erro ao inserir"]);
        }
    }
}

$conn->close();
?>