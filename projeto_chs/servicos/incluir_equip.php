<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');
require_once('../classes/servicoPrincipal.php');

$nomeEquipamento = $_POST['nomeEquipamento'];
$usuario = $_POST['usuarioId'];
$tipo = 'Equipamento';
$config = new Config();
$servico = new Servico();

if(isset($nomeEquipamento) && $nomeEquipamento !== ''){ 

    try{
        $valida_regra = $servico->limiteCinco($usuario, 'chs_equipamento');

        if ($valida_regra == FALSE){
            throw new Exception("Limite excedido " . $config->conn->error);
        }

        $queryExistente = $servico->buscaGenerica('a.id', 'chs_equipamento a', "WHERE a.nome = '" . $nomeEquipamento . "'");
    
        if (!empty($queryExistente)){
            echo json_encode(['erro' => 1,'mensagem' => "Ja existe este nome!"]);
        } else{
            $sql = "INSERT INTO chs_equipamento (nome, tipo, usuario_id) VALUES ('" . $nomeEquipamento . "','" . $tipo . "', $usuario)";
            if ($config->conn->query($sql) === TRUE) {
                echo json_encode(['erro' => 0,'mensagem' => "Inserido!"]);
            } else {
                echo json_encode(['erro' => 1,'mensagem' => "Erro ao inserir"]);
            }
        }

    } catch (Exception $e) {
        echo json_encode(['erro' => 0,'mensagem' => "Limite de 3 registros atingido!"]);
    }


}
?>