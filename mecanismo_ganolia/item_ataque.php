<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('../config.php');

$codigoItemAtaque = $_POST['codigoItemAtaque'];

$resposta = array();

if(isset($codigoItemAtaque) && $codigoItemAtaque !== ''){ 
    $select = "SELECT * FROM item_ataque WHERE codigo = '$codigoItemAtaque'";
    $resultado = $conn->query($select);

    if ($resultado->num_rows > 0){
        $linha = $resultado->fetch_assoc();
        $nome = $linha['nome'];
        $tipo = $linha['tipo'];
        $raridade = $linha['raridade'];
        $dano = $linha['damage'];
        $imagem = $linha['imagem'];
        $conversaoDano = json_decode($linha['damage'], true);
        $primeiroDano = reset($conversaoDano);
        $ultimoDano = end($conversaoDano);
        $danoCombinado = $primeiroDano . ' - ' . $ultimoDano;
        // $indiceAleatorio = rand(0, count($damage) - 1);
        // $damageAleatorio = $damage[$indiceAleatorio];

        $resposta['success'] = true;
        $resposta['nome'] = $nome;
        $resposta['tipo'] = $tipo;
        $resposta['raridade'] = $raridade;
        $resposta['danoCombinado'] = $danoCombinado;
        $resposta['imagem'] = $imagem;
    } else {
        $resposta['success'] = false;
        $resposta['message'] = 'Item de ataque não encontrado.';
    }
} else {
    $resposta['success'] = false;
    $resposta['message'] = 'Código de ataque não fornecido.';
}

$conn->close();
echo json_encode($resposta);
?>
