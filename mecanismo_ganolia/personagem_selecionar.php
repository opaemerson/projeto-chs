<?php
include('../protecao.php');
require_once('../config.php');
header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_SESSION['id'];
    $nome = $_POST['nome'];
    $classe = $_POST['classe'];

    if (empty($nome) || empty($classe)) {
        echo "<script>alert('Todos os campos precisam ser preenchidos');</script>";
    } else {
    
        $nomeExistente = "SELECT gp.nome FROM ganolia_personagem gp WHERE nome = '$nome'";
        $resultado = $conn->query($nomeExistente);
    
        if ($resultado->num_rows > 0 || $resultado == FALSE){
            echo "<script>alert('Nome já existe / Falha na busca');</script>";
        } else {
            $insert = "INSERT INTO ganolia_personagem (nome, classe, sessao, usuario_id) 
            VALUES ('$nome', '$classe', '', '$usuario')";

            //tratativa caso der b.o na insercao
            if ($conn->query($insert) === TRUE) {
                echo "<script>alert('Salvo no banco de dados!');</script>";
                echo "<script>window.location.href = 'guia_personagem.php';</script>"; 
            } else {
                echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
            }}
    }
}
?>