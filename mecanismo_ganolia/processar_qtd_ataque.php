<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $atk = $_POST['atk'];

    if($atk){
        $buscaAtual = "SELECT
        gst.ataque_ativo as atk,
        gst.qtd_ataque as qtd
        FROM ganolia_sessao_tmp gst
        WHERE personagem_id = $personagemId";

        $resu = $conn->query($buscaAtual);

        if ($resu === FALSE) {
            echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
        }
        
        $row = $resu->fetch_assoc();
        $qtdAtual = $row['qtd'];
        $atkAtual = $row['atk'];

        //parei aqui tenho que remover o ultimo ;
        // if($atkAtual !== ''){
        //     $atkAtual = rtrim($atkAtual, ';');
        // }

        $qtdAtk = $qtdAtual + 1;
        $atk = $atkAtual . $atk . ";";

        $sql = "UPDATE ganolia_sessao_tmp gst
        SET gst.ataque_ativo = '$atk',
        gst.qtd_ataque = $qtdAtk
        WHERE personagem_id = $personagemId";

        $resultado = $conn->query($sql);

        if ($resultado === FALSE) {
            echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
        }

    }
    else {
        echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
    }

    $conn->close();
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>




