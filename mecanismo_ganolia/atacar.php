<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('../config.php');

$codigoItemAtaque = $_POST['codigoItemAtaque'];

$resposta = array();

if(isset($codigoItemAtaque) && $codigoItemAtaque !== ''){ 
    $select = "SELECT * FROM ganolia_item WHERE id = '$codigoItemAtaque'";
    $resultado = $conn->query($select);

    if ($resultado->num_rows > 0){
        $linha = $resultado->fetch_assoc();
        $nome = $linha['nome'];
        $tipo = $linha['tipo'];
        $raridade = $linha['raridade'];
        $imagem = $linha['imagem'];
        $damage = $linha['damage'];
        $damagePossivel = explode(";", $damage);
        $indiceAleatorio = rand(0, count($damagePossivel) - 1);
        $damageAleatorio = $damagePossivel[$indiceAleatorio];

        $resposta['success'] = true;
        $resposta['nome'] = $nome;
        $resposta['tipo'] = $tipo;
        $resposta['raridade'] = $raridade;
        if (isset($damageAleatorio)) {
            $resposta['damageAleatorio'] = $damageAleatorio;
        } else {
            $resposta['damageAleatorio'] = '';
        }
        $resposta['imagem'] = $imagem;
    } else {
        $resposta['success'] = false;
        $resposta['message'] = 'Item não encontrado.';
    }
} else {
    $resposta['success'] = false;
    $resposta['message'] = 'Código do item não fornecido.';
}

$conn->close();
echo json_encode($resposta);
?>
