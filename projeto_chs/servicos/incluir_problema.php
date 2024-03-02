<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');

$nomeProblema = $_POST['nomeProblema'];
$tipo = 'Problema';

if(isset($nomeProblema) && $nomeProblema !== ''){ 
    $problemaExistente = "SELECT * FROM chs_problema WHERE nome = '$nomeProblema'";
    $resultado = $conn->query($problemaExistente);

    if ($resultado->num_rows > 0){
        echo json_encode(['erro' => 1,'mensagem' => "Ja existe este nome!"]);
    } else{
        $sql = "INSERT INTO chs_problema (nome,tipo) VALUES ('".$nomeProblema."','".$tipo."')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['erro' => 0,'mensagem' => "Inserido!"]);
        } else {
            echo json_encode(['erro' => 1,'mensagem' => "Erro ao inserir"]);
        }
    }
}

$conn->close();
?>