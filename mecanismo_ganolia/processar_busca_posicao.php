<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

?>

<?php
$sql = "SELECT gs.row, gs.col, gs.territorio_id as territorio
 FROM ganolia_sessao gs 
 WHERE personagem_id = $personagemId";

$resultado = $conn->query($sql);

// Verificar se a consulta foi bem-sucedida
if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    echo json_encode($row);
} else {
    echo json_encode(array("error" => "Jogador não encontrado"));
}


$conn->close();
?>