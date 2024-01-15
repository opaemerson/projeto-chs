<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arrayAtaques = $_POST['arrayAtaques'];

    echo json_encode(array("success" => true, "message" => "sucess "));

}

else {
    echo json_encode(array("success" => false, "message" => "Erro ao busca itens de ataque: " . $conn->error));
}

?>
