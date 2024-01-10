<?php
include('../protecao.php');
require_once('../config.php');

$usuarioId = $_SESSION['id'];

?>

<?php
$sql = "SELECT gs.row, gs.col FROM ganolia_sessao gs WHERE id = 1";

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