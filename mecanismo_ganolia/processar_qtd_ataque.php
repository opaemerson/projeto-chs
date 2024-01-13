<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ativo = $_POST['ativo'];

    $sql = "UPDATE ganolia_sessao_tmp gst
    SET gst.ataque_ativo = $equipamentos
    WHERE personagem_id = $personagemId";

    $resultado = $conn->query($sql);

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => true, "message" => "Posição atualizada com sucesso"));
    } else {
        echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
    }

    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>




