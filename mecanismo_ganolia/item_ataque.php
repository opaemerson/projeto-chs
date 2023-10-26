<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('../config.php');

$codigoItemAtaque = $_POST['codigoItemAtaque'];

$resposta = array();

if(isset($codigoItemAtaque) && $codigoItemAtaque !== ''){ 
    $select = "SELECT * FROM ganolia_item WHERE id = '$codigoItemAtaque' AND categoria = 'Ataque'";
    $resultado = $conn->query($select);

    if ($resultado->num_rows > 0){
        $linha = $resultado->fetch_assoc();
        $nome = $linha['nome'];
        $tipo = $linha['tipo'];
        $raridade = $linha['raridade'];
        $imagem = $linha['imagem'];
        $damage = $linha['damage'];

        if ($damage != '' || $damage != null){
            $damage = $linha['damage'];
            $damagePossivel = explode(";", $damage);
            $damageVisual = $damagePossivel[0] . " - " . $damagePossivel[count($damagePossivel) - 1];
        }

        $resposta['success'] = true;
        $resposta['nome'] = $nome;
        $resposta['tipo'] = $tipo;
        $resposta['raridade'] = $raridade;
        if (isset($damageVisual)) {
            $resposta['damageVisual'] = $damageVisual;
        } else {
            $resposta['damageVisual'] = '';
        }
        $resposta['imagem'] = $imagem;
    } else {
        $resposta['success'] = false;
        $resposta['message'] = 'Item não pertence a categoria de Ataque.';
    }
} else {
    $resposta['success'] = false;
    $resposta['message'] = 'Código do item não fornecido.';
}

$conn->close();
echo json_encode($resposta);
?>
