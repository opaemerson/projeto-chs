<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');
require_once('../classes/regras_chs.php');

$nomeProblema = $_POST['nomeProblema'];
$tipo = 'Problema';

if(isset($nomeProblema) && $nomeProblema !== ''){ 

    try{
        $valida_regra = (new Regras())->limite_cinco($usuarioSessao, 'chs_problema');

        if ($valida_regra == FALSE){
            throw new Exception("Limite excedido " . $conn->error);
        }

        $problemaExistente = "SELECT * FROM chs_problema WHERE nome = '$nomeProblema'";
        $resultado = $conn->query($problemaExistente);

        if ($resultado->num_rows > 0){
            echo json_encode(['erro' => 1,'mensagem' => "Ja existe este nome!"]);
        } else{
            $sql = "INSERT INTO chs_problema (nome,tipo,usuario_id) VALUES ('".$nomeProblema."','".$tipo."', $usuarioSessao)";
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