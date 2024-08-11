<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');
require_once('../classes/servicoPrincipal.php');

$nomeMarca = $_POST['nomeMarca'];
$usuario = $_POST['usuarioId'];
$tipo = 'Marca';

$config = new Config();
$servico = new Servico();

if(isset($nomeMarca) && $nomeMarca !== ''){ 

    try{
        $valida_regra = $servico->limiteCinco($usuario, 'chs_marca');

        if ($valida_regra == FALSE){
            throw new Exception("Limite excedido " . $config->conn->error);
        }

        $marcaExistente = "SELECT * FROM chs_marca WHERE nome = '$nomeMarca'";
        $resultado = $config->conn->query($marcaExistente);

        if ($resultado->num_rows > 0){
            echo json_encode(['erro' => 1,'mensagem' => "Ja existe esta marca!"]);
        } else{
            $sql = "INSERT INTO chs_marca (nome, tipo, usuario_id) VALUES ('" . $nomeMarca . "','" . $tipo . "', $usuario)";
            if ($config->conn->query($sql) === TRUE) {
                echo json_encode(['erro' => 0,'mensagem' => "Marca Inserida!"]);
            } else {
                echo json_encode(['erro' => 1,'mensagem' => "Erro ao inserir marca"]);
            }
        }

    } catch (Exception $e) {
        echo json_encode(['erro' => 0,'mensagem' => "Limite de 3 registros atingido!"]);
    }
}

$config->conn->close();
?>