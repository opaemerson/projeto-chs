<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../config.php');

$nomeMarca = $_POST['nomeMarca'];

if(isset($nomeMarca) && $nomeMarca !== ''){ 
    $marcaExistente = "SELECT * FROM marca WHERE nome = '$nomeMarca'";
    $resultado = $conn->query($marcaExistente);

    if ($resultado->num_rows > 0){
        echo json_encode(['erro' => 1,'mensagem' => "Ja existe esta marca!"]);
    } else{
        $sql = "INSERT INTO marca (nome) VALUES ('".$nomeMarca."')";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['erro' => 0,'mensagem' => "Marca Inserida!"]);
        } else {
            echo json_encode(['erro' => 1,'mensagem' => "Erro ao inserir marca"]);
        }
    }
}

$conn->close();
?>