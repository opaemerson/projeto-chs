<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

function limpaTmp($personagemId, $conn){
    $sql = "UPDATE ganolia_sessao_tmp gst
    SET gst.ataque_ativo = '', gst.qtd_ataque = 0
    WHERE personagem_id = $personagemId";

    $resultado = $conn->query($sql);

    if ($resultado !== FALSE) {
        return true;
    } else {
        return false;
    }
}

function buscaMao($personagemId, $conn){
    $sql = "SELECT gs.mao
    FROM ganolia_sessao gs
    WHERE gs.personagem_id = $personagemId";

    $resultado = $conn->query($sql);
        
    if ($resultado !== FALSE) {
        $row = $resultado->fetch_assoc();
        $mao = $row['mao'];
        
        return $mao;

    } else {
        return false;
    }
}

function insereDescarte($personagemId, $mao, $conn){
    $update = "UPDATE ganolia_sessao gs
    SET gs.descarte = '$mao',
    gs.mao = ''
    WHERE personagem_id = $personagemId";

    $resultado = $conn->query($update);

    if ($resultado !== FALSE) {
        return true;
    } else {
        return false;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ativo = $_POST['ativo'];

    if($ativo == '1'){

        //limpa a sessao temporária
        limpaTmp($personagemId, $conn);

        //busca a mao atual para inserir no descarte
        $mao = buscaMao($personagemId,$conn);

        if ($mao !== ''){
            insereDescarte($personagemId, $mao, $conn);
        }


    } else{
        echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
    }

    $conn->close();
    $correto = 1;
    $resposta['success'] = true;
    $resposta['correto'] = $correto;
    echo json_encode($resposta);

} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>




