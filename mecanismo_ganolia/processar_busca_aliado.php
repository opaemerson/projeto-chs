<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newFila = $_POST['newFila'];

    $sql = "SELECT 
            gs.territorio_id as territorio,
            gs.row,
            gs.col
            FROM ganolia_sessao gs
            WHERE gs.fila <> $newFila";

    $result = $conn->query($sql);

    if ($result !== false) {
        // Verifica se há pelo menos uma linha retornada
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode(array("success" => true, "message" => "Aliado envidenciado", "data" => $rows));
        } else {
            echo json_encode(array("success" => true, "message" => "Nenhum aliado encontrado"));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Erro ao buscar fila. Detalhes do erro: " . $conn->error));
    }

    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>
