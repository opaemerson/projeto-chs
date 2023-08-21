<?php
header('Access-Control-Allow-Origin: *');
// Código de conexão ao banco de dados
require_once('config.php');

// Verificar se o ID foi fornecido
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Query para remover o item do banco de dados
    $sql = "DELETE FROM heads WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Item removido com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao remover o item: " . $conn->error . "');</script>";
    }
} else {
    echo "<script>alert('ID não fornecido');</script>";
}

$conn->close();
?>
