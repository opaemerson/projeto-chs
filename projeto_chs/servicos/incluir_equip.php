<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');
require_once('../classes/regras_chs.php');

$nomeEquipamento = $_POST['nomeEquipamento'];
$tipo = 'Equipamento';

if(isset($nomeEquipamento) && $nomeEquipamento !== ''){ 

    try{
        $valida_regra = (new Regras())->limite_cinco($usuarioSessao, 'chs_equipamento');

        if ($valida_regra == FALSE){
            throw new Exception("Limite excedido " . $conn->error);
        }

        $queryExistente = "SELECT * FROM chs_equipamento WHERE nome = '$nomeEquipamento'";
        $resultado = $conn->query($queryExistente);
    
        if ($resultado->num_rows > 0){
            echo json_encode(['erro' => 1,'mensagem' => "Ja existe este nome!"]);
        } else{
            $sql = "INSERT INTO chs_equipamento (nome, tipo, usuario_id) VALUES ('" . $nomeEquipamento . "','" . $tipo . "', $usuarioSessao)";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['erro' => 0,'mensagem' => "Inserido!"]);
            } else {
                echo json_encode(['erro' => 1,'mensagem' => "Erro ao inserir"]);
            }
        }

    } catch (Exception $e) {
        echo json_encode(['erro' => 0,'mensagem' => "Limite de 3 registros atingido!"]);
    }


}

$conn->close();
?>