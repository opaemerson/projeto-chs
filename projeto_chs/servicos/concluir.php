<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');

$tagId = $_POST['tagId'];
$data_previsao = 'Concluido';
$situacao = 'Concluido';
$data_retorno = date('Y-m-d'); 

    
    if (!empty($tagId) || !empty($usuario)){
        
        $update = "UPDATE chs_controle SET 
        situacao = ?, 
        previsao = ?, 
        retorno = ? 
        WHERE id = ?";

        $stmt = $conn->prepare($update);
  
        if (!$stmt) {
            throw new Exception("Erro ao preparar a consulta para atualiza no controle: " . $conn->error);
        }

        $stmt->bind_param("sssi", $situacao, $data_previsao, $data_retorno, $tagId);
        
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo json_encode([
                'erro' => 0,
                'message" => "Dado editado com sucesso'
                ]);
        } else {
            echo json_encode([
                'erro' => 1,
                'mensagem' => "Erro ao concluir evento"
                ]);
        }
        
        $stmt->close();
        
    } else {
        echo json_encode(['erro' => 1,'mensagem' => "Erro ao concluir evento"]);
    }
?>
