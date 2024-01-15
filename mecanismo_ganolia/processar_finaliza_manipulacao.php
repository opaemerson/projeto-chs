<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ativo = $_POST['ativado'];

    if($ativo == 1){
        $buscaDados = "SELECT
        gst.ataque_ativo as ataque_ativo,
        gst.qtd_ataque as qtd_atq
        FROM ganolia_sessao_tmp gst
        WHERE personagem_id = $personagemId";
        
        $resultado = $conn->query($buscaDados);

        if ($resultado === FALSE) {
            echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
        }

        $row = $resultado->fetch_assoc();
        $quantidade = $row['qtd_atq'];
        $ataques = $row['ataque_ativo'];

        $resposta['success'] = true;
        $resposta['quantidade'] = $quantidade;
        $resposta['ataques'] = $ataques;

        echo json_encode($resposta);
    }
    else {
        echo json_encode(array("success" => false, "message" => "Erro ao busca itens de ataque: " . $conn->error));
    }

    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>




