<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('../config.php');
require_once('../api/src/SistemaChat.php');
date_default_timezone_set('America/Sao_Paulo');

$codigoItemAtaque = $_POST['codigoItemAtaque'];
$usuario = (isset($_SESSION['id']) && $_SESSION['id']) ? $_SESSION['id'] : null;


$resposta = array();

if(isset($codigoItemAtaque) && $codigoItemAtaque !== '' && !empty($usuario)){ 
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
        $resposta['damageAleatorio'] = isset($damageAleatorio) ? $damageAleatorio : '';
        $resposta['imagem'] = $imagem;

        $verPersonagem = "SELECT gh.evento as evento, 
        gp.id as id
        from ganolia_historico gh 
        inner join ganolia_personagem gp 
        on gp.id = gh.personagem_id
        WHERE gp.usuario_id = $usuario";

        $conHistorico = $conn->query($verPersonagem);

        if ($conHistorico == FALSE){
            die("Erro na consulta: " . $conn->error);
        }

        $rw = $conHistorico->fetch_assoc();
        $horario = date('Y-m-d H:i:s');
        $idPersonagem = $rw['id'];
        $evento = 'Acertou ' . $damageAleatorio . ' de dano no alvo.';

        $inserEvento = "INSERT INTO ganolia_historico
        (personagem_id, evento, horario)
        VALUES ($idPersonagem, '$evento', '$horario')";

        if ($conn->query($inserEvento) === FALSE) {
            die("Erro na consulta: " . $conn->error);
        }

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
