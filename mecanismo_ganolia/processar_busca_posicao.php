<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

?>

<?php
$sql = "SELECT gs.row, 
gs.col, 
gs.territorio_id as territorio, 
gs.fila as fila, 
gs.personagem_id as player,
gs.vez as vez
FROM ganolia_sessao gs
WHERE gs.personagem_id = $personagemId";

$resultado = $conn->query($sql);

// Verificar se a consulta foi bem-sucedida
if ($resultado->num_rows > 0) {
    $rows = array();
    while ($row = $resultado->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo json_encode(array("error" => "Jogador não encontrado"));
}


$conn->close();
?>