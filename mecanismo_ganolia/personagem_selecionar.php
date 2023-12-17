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
    $idPersonagem = $_POST['selectPersonagem'];

    var_dump($idPersonagem);

    if (empty($idPersonagem)) {
        echo "<script>alert('Todos os campos precisam ser preenchidos');</script>";
    } else {
    
        $nomeExistente = "SELECT gp.id
        FROM ganolia_personagem gp
        WHERE usuario_id = '$usuario'";

        $resultado = $conn->query($nomeExistente);
    
        if ($resultado == FALSE){
            echo "<script>alert(Falha ao selecionar');</script>";
        } else {
            $update = "UPDATE usuarios
            SET personagem_ganolia = $idPersonagem
            WHERE id = $usuario";

            //tratativa caso der b.o na insercao
            if ($conn->query($update) === TRUE) {
                echo "<script>alert('Personagem selecionado!');</script>";
                echo "<script>window.location.href = 'guia_personagem.php';</script>"; 
            } else {
                echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
            }}
    }
}
?>