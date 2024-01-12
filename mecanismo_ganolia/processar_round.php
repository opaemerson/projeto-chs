<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

$resposta = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ativado = $_POST['ativado'];

    if($ativado == 1){
        $sql_escolhendo = "SELECT gp.mochila as mochila,
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
        $descarte = $row['descarte'];


        if ($mao == ''){
            $arrayDescarte = explode(";", $descarte);
            $arrayMochila = explode(";", $mochila);
            $arrayDisponivel = [];

            foreach ($arrayMochila as $key) {
                if (in_array($key, $arrayDescarte)) {
                    continue;
                } else {
                    $arrayDisponivel[] = $key;
                }
            }

            $pegaCinco = array_rand($arrayDisponivel, 5);
            $porEscrito = '';
    
            foreach ($pegaCinco as $indice) {
                $valor = $arrayDisponivel[$indice];
                $porEscrito .= $valor;

                if ($indice !== end($pegaCinco)) {
                    $porEscrito .= ';';
                }
            }

            $insertEscrito = "UPDATE ganolia_sessao gs
            SET gs.mao = '$porEscrito'
            WHERE gs.personagem_id = $personagemId";

            $update = $conn->query($insertEscrito);
            
            if ($update === FALSE) {
                echo json_encode(array("success" => false, "message" => "Erro ao executar sql escolhendo: " . $conn->error));
            } 

            $resposta['success'] = true;
            $resposta['mao'] = $porEscrito;

        } else{
            $resposta['success'] = true;
            $resposta['mao'] = $mao;
        }
    }

    $conn->close();
    echo json_encode($resposta);
} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>




