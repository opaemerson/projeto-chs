<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newRow = $_POST['newRow'];
    $newCol = $_POST['newCol'];

    $sql = "UPDATE ganolia_sessao gs 
    SET gs.row = $newRow, gs.col = $newCol
    WHERE personagem_id = $personagemId";

    $resultado = $conn->query($sql);

    if ($conn->query($sql) === TRUE) {
        // Resposta de sucesso
        echo json_encode(array("success" => true, "message" => "Posição atualizada com sucesso"));
    } else {
        // Resposta de erro
        echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
    }

    // Fecha a conexão
    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>




