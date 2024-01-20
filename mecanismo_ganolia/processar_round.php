<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];
$resposta = array();

function buscaImagem($id, $conn){
    $sqlzin = "SELECT gi.imagem as imagem
    FROM ganolia_item gi
    WHERE gi.id = $id";

    $result = $conn->query($sqlzin);

    if ($result === FALSE) {
        echo json_encode(array("success" => false, "message" => "Erro ao executar sql escolhendo: " . $conn->error));
    }
    
    $linhaDaImagem = $result->fetch_assoc();
    $imagem = $linhaDaImagem['imagem'];

    return $imagem;
}

function buscaCategoria($id, $conn){
    $sqlzin = "SELECT gi.categoria as categoria
    FROM ganolia_item gi
    WHERE gi.id = $id";

    $result = $conn->query($sqlzin);

    if ($result === FALSE) {
        echo json_encode(array("success" => false, "message" => "Erro ao executar sql escolhendo: " . $conn->error));
    }
    
    $linhaDaCategoria = $result->fetch_assoc();
    $categoria = $linhaDaCategoria['categoria'];

    return $categoria;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ativado = $_POST['ativado'];

    if($ativado == 1){
        $sql_escolhendo = "SELECT gp.mochila as mochila,
        gp.mochila_indice as mochila_indice,
        gs.mao as mao,
        gs.descarte as descarte
        FROM ganolia_personagem gp
        INNER JOIN ganolia_sessao gs
        ON gs.personagem_id = gp.id
        WHERE gp.id = $personagemId";

        $resultado = $conn->query($sql_escolhendo);

        if ($resultado === FALSE) {
            echo json_encode(array("success" => false, "message" => "Erro ao executar sql escolhendo: " . $conn->error));
        } 

        $row = $resultado->fetch_assoc();
        $mao = $row['mao'];
        $mochila = $row['mochila'];
        $mochila_indice = $row['mochila_indice'];
        $descarte = $row['descarte'];

        if ($mao == ''){
            $arrayDescarte = explode(";", $descarte);
            $arrayMochila = explode(";", $mochila);
            $arrayMochilaIndice = explode(";", $mochila_indice);
            $arrayDisponivel = [];
            $porEscrito = '';
            $arrayImagens = [];
            $arrayCategorias = [];

            foreach ($arrayMochilaIndice as $k){
                if (in_array($k, $arrayDescarte)){
                    continue;
                }else{
                    $disponivel = $arrayMochila[$k];
                    $arrayDisponivel[] = $disponivel;
                }
            }
            
            if(count($arrayDisponivel) < 5){
                $removeDescarte = "UPDATE ganolia_sessao gs
                    SET gs.descarte = ''
                    WHERE gs.personagem_id = $personagemId";
        
                $removv = $conn->query($removeDescarte);
        
                if ($removv === FALSE) {
                    echo json_encode(array("success" => false, "message" => "Erro ao executar SQL escolhendo: " . $conn->error));
                }
            }

            $pegaCinco = array_rand($arrayDisponivel, 5);
            $mao_js = '';

            foreach ($pegaCinco as $indice) {
                $valor = $arrayDisponivel[$indice];
                $porEscrito .= $indice;
                $mao_js .= $valor;

                if ($indice !== end($pegaCinco)) {
                    $porEscrito .= ';';
                    $mao_js .= ';';
                }

                $img = buscaImagem($valor, $conn);
                $categoria = buscaCategoria($valor, $conn);

                $arrayImagens[] = $img;
                $arrayCategorias[] = $categoria;
            }

            $insertEscrito = "UPDATE ganolia_sessao gs
            SET gs.mao = '$porEscrito'
            WHERE gs.personagem_id = $personagemId";

            $update = $conn->query($insertEscrito);
            
            if ($update === FALSE) {
                echo json_encode(array("success" => false, "message" => "Erro ao executar sql escolhendo: " . $conn->error));
            } 

            $resposta['success'] = true;
            $resposta['mao'] = $mao_js;
            $resposta['imagem'] = $arrayImagens;
            $resposta['categoria'] = $arrayCategorias;

        } else{
            $resposta['success'] = false;
            $resposta['message'] = 'MAO PREENCHIDA, CONTATE O ADM';
        }
    }

    $conn->close();
    echo json_encode($resposta);
} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>