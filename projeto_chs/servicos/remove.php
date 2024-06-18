<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../config.php');


if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $usuario = $_POST['idUsuario'];
    $usuarioSessao = $_POST['usuarioSessao'];
    $permissaoSessao = $_POST['permissaoSessao'];
    $sql = "SELECT * FROM chs_historico WHERE tag_id = '$id' order by id DESC";
    $resultado = $conn->query($sql) or die("Falha na execucao do codigo SQL: " . $conn->error);
    $row = $resultado->fetch_assoc();
    $usuarioConsultado = $row['usuario_id'];
    $idHistorico= $row['id'];
    $permissaoUsuario = 'Usuario';
    
    if ($usuarioConsultado === $usuarioSessao || $permissaoSessao === 'Admin'){
        $sqlDeleteHistorico = "DELETE FROM chs_historico WHERE tag_id = $id";
        
        $response = [];
        
        if ($conn->query($sqlDeleteHistorico) === TRUE) {
            $response['historico'] = ['erro' => 0,'mensagem' => "ok"];
        } else {
            $response['historico'] = ['erro' => 1,'mensagem' => "Erro ao remover o item"];
        }
        
        $sqlDelete = "DELETE FROM chs_controle WHERE id = $id";
        
        if ($conn->query($sqlDelete) === TRUE) {
            $response['heads'] = ['erro' => 0,'mensagem' => "ok"];
        } else {
            $response['heads'] = ['erro' => 1,'mensagem' => "Erro ao remover o item"];
        }
        
        echo json_encode($response);
    } else {
        echo json_encode(['erro' => 1,'mensagem' => "Você não tem permissão para remover este item"]);
    }
}
 else {
    echo json_encode(['erro' => 1,'mensagem' => "deu ruim"]);
}

$conn->close();
?>
