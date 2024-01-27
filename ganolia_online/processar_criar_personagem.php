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
        echo "<script>window.location.href = 'guia_personagem.php';</script>";
    } else {
    
        $nomeExistente = "SELECT gp.nome FROM ganolia_personagem gp WHERE nome = '$nome'";
        $resultado = $conn->query($nomeExistente);
    
        if ($resultado->num_rows > 0 || $resultado == FALSE){
            echo "<script>alert('Nome já existe / Falha na busca');</script>";
            echo "<script>window.location.href = 'guia_personagem.php';</script>";
        } else {
            $insert = "INSERT INTO ganolia_personagem (nome, classe, sessao, usuario_id) 
            VALUES ('$nome', '$classe', '', '$usuario')";

        if ($conn->query($insert) === TRUE) {
            $verCodigoCriado = "SELECT id FROM ganolia_personagem WHERE nome = '$nome'";
            $resu = $conn->query($verCodigoCriado);
            $lita = $resu->fetch_assoc();
            $codigo = $lita['id'];

            $insertHistorico = "INSERT INTO ganolia_historico (personagem_id, evento, item_usado, horario)
            VALUES ($codigo, 'Registrado', '', '2023-12-16 00:00:00')";

            if ($conn->query($insertHistorico) === FALSE) {
                echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
                echo "<script>window.location.href = 'guia_personagem.php';</script>";
            } else {
                $insertPersonagem = "UPDATE chs.usuarios 
                SET personagem_ganolia = $codigo
                WHERE id = $usuario;";

                    if ($conn->query($insertPersonagem) === FALSE) {
                        echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
                        echo "<script>window.location.href = 'guia_personagem.php';</script>";
                    } else{
                        echo "<script>alert('Salvo no banco de dados!');</script>";
                        echo "<script>window.location.href = 'guia_personagem.php';</script>";
                    }
                }
            } else {
                echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
            }
        }
    }
}
?>