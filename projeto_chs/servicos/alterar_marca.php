<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');

$id = $_POST['id'];
$nome = $_POST['nome'];

if(isset($nome) && $nome !== ''){ 
    $queryExistente = "SELECT * FROM chs_marca WHERE nome = '$nome'";
    $resultado = $conn->query($queryExistente);

    if ($resultado->num_rows > 0){
        echo json_encode(['sucess' => false,'mensagem' => "Nome nao teve alteracao"]);
    } else{
        $sql = "UPDATE gobinc.chs_marca
        SET nome = '$nome'
        WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true,'mensagem' => "Alterado!"]);
        } else {
            echo json_encode(['success' => false,'mensagem' => "Erro ao inserir"]);
        }
    }
}

$conn->close();
?>