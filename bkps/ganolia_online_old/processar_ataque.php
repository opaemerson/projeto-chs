<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('../config.php');
date_default_timezone_set('America/Sao_Paulo');

$itemAtaque = $_POST['itemAtaque'];
$criatura = $_POST['criatura'];

$usuario = (isset($_SESSION['id']) && $_SESSION['id']) ? $_SESSION['id'] : null;
$personagemId = (isset($_SESSION['personagem_ganolia']) && $_SESSION['personagem_ganolia']) ? $_SESSION['personagem_ganolia'] : null;
$classe = (isset($_SESSION['personagem_classe']) && $_SESSION['personagem_classe']) ? $_SESSION['personagem_classe'] : null;

$resposta = array();

function buscaCriatura($criatura, $conn){
    try {
        $sql = "SELECT gs.criatura_hp as hp_criatura,
                gc.cp as cp_criatura,
                gs.criatura_id as criatura_id,
                gc.nome as criatura_nome
                FROM ganolia_criatura gc
                INNER JOIN ganolia_sessao gs ON gc.id = gs.criatura_id
                WHERE gc.nome = '$criatura'";

        $resultado = $conn->query($sql);

        if ($resultado === FALSE) {
            throw new Exception("Erro na consulta SQL: " . $conn->error);
        }

        $linha = $resultado->fetch_assoc();

        if ($linha) {
            $hp_criatura = $linha['hp_criatura'];
            $cp_criatura = $linha['cp_criatura'];
            $criatura_id = $linha['criatura_id'];
            $criatura_nome = $linha['criatura_nome'];
            return array('hp_criatura' => $hp_criatura, 
            'cp_criatura' => $cp_criatura,
            'criatura_id' => $criatura_id,
            'criatura_nome' => $criatura_nome);
        } else {
            return null;
        }
    } catch (Exception $e) {
        error_log("Erro na buscaCriatura: " . $e->getMessage());
        return false;
    }
}

function subtraiDano($dano,$criatura_id,$conn){
    try{
        $update = "UPDATE ganolia_sessao gs
        SET gs.criatura_hp = gs.criatura_hp - $dano
        WHERE gs.criatura_id = $criatura_id";

        $resultado = $conn->query($update);

        if ($resultado === FALSE) {
            throw new Exception("Erro na consulta SQL: " . $conn->error);
        }

        $consulta_hp = "SELECT gs.criatura_hp as criatura_hp
        FROM ganolia_sessao gs
        WHERE gs.criatura_id = $criatura_id";

        $res = $conn->query($consulta_hp);

        if ($res === FALSE) {
            throw new Exception("Erro na consulta SQL: " . $conn->error);
        }

        $row = $res->fetch_assoc();
        $hp_alvo = $row['criatura_hp'];

        return $hp_alvo;

    }catch (Exception $e) {
        error_log("Erro na buscaCriatura: " . $e->getMessage());
        return false;
    }
}

function updateQtd($personagemId, $conn){
    try{
        $update = "UPDATE ganolia_sessao_tmp gst
        SET gst.qtd_ataque = gst.qtd_ataque - 1
        WHERE gst.personagem_id = $personagemId";

        $resultado = $conn->query($update);

        if ($resultado === FALSE) {
            throw new Exception("Erro na consulta SQL: " . $conn->error);
        }

        $select = "SELECT gst.qtd_ataque as quantidade
        FROM ganolia_sessao_tmp gst
        WHERE gst.personagem_id = $personagemId";

        $result = $conn->query($select);

        if($result === FALSE){
            throw new Exception("Erro na consulta SQL: " . $conn->error);
        }

        $rw = $result->fetch_assoc();
        $quantidade = $rw['quantidade'];

        return $quantidade;

    }catch (Exception $e) {
        error_log("Erro na buscaCriatura: " . $e->getMessage());
        return false;
    }
}

function infoGeral($conn){
    $sqlInfo = "SELECT
    (select gp.nome from ganolia_personagem gp where gs.personagem_id = gp.id and gs.personagem_id <> 99) as nome_personagem,
    (select gs.personagem_hp from ganolia_personagem x where gs.personagem_id = x.id and gs.personagem_id <> 99) as hp_personagem,
    (select y.nome from ganolia_criatura y where y.id = gs.criatura_id and gs.personagem_id = 99) as nome_criatura,
    (select gs.criatura_hp from ganolia_criatura y where y.id = gs.criatura_id and gs.personagem_id = 99) as hp_criatura
    FROM ganolia_criatura gc
    INNER JOIN ganolia_sessao gs
    ON gs.criatura_id = gc.id";

    $rr = $conn->query($sqlInfo);

    $arrayNomePersonagem = [];
    $arrayHpPersonagem = [];
    $arrayNomeCriatura = [];
    $arrayHpCriatura = [];

    if ($rr) {
        while ($lita = $rr->fetch_assoc()) {
        $nomePersonagem = $lita['nome_personagem'];
        $hpPersonagem = $lita['hp_personagem'];
        $nomeCriatura = $lita['nome_criatura'];
        $hpCriatura = $lita['hp_criatura'];

        if($nomePersonagem !== NULL ){
            $arrayNomePersonagem[] = $nomePersonagem;
            $arrayHpPersonagem[] = $hpPersonagem;
        }

        if($nomeCriatura !== NULL){
            $arrayNomeCriatura[] = $nomeCriatura;
            $arrayHpCriatura[] = $hpCriatura;
        }
        
        }

        return [
            'nomePersonagem' => $arrayNomePersonagem,
            'hpPersonagem' => $arrayHpPersonagem,
            'nomeCriatura' => $arrayNomeCriatura,
            'hpCriatura' => $arrayHpCriatura
        ];

        $rr->close();
    } else {
        return false;
    }
}

function removeAlvo($criatura, $conn){
    $delete = "DELETE
    FROM ganolia_sessao 
    WHERE criatura_id = '$criatura'";

    $resultado = $conn->query($delete);

    if ($resultado === FALSE) {
        return false;
    }

    return true;
}

function buscaIdCriatura($criatura, $conn){
    $sql = "SELECT
    gs.criatura_id as criatura_id
    FROM ganolia_criatura gc
    INNER JOIN ganolia_sessao gs 
    ON gc.id = gs.criatura_id
    WHERE gc.nome = '$criatura'";

    $resultado = $conn->query($sql);

    if ($resultado === FALSE) {
    return false;
    } else{
        $linha = $resultado->fetch_assoc();
        $id = $linha['criatura_id'];
        return $id;
    }

}

if(isset($itemAtaque) && $itemAtaque !== '' && !empty($usuario)){ 
    $select = "SELECT * FROM ganolia_item WHERE id = '$itemAtaque'";
    $resultado = $conn->query($select);

    if ($resultado->num_rows > 0){
        $linha = $resultado->fetch_assoc();
        $nome = $linha['nome'];
        $tipo = $linha['tipo'];
        $raridade = $linha['raridade'];
        $imagem = $linha['imagem'];
        $damage = $linha['damage'];

        $arrayCp = [1,2,3,4,5,6,7,8,9,10,11,12];
        $iAleatorio = array_rand($arrayCp);
        $randomico = $arrayCp[$iAleatorio];
        $arrayCria = buscaCriatura($criatura, $conn);

        if($randomico >= $arrayCria['cp_criatura']){
            $damagePossivel = explode(";", $damage);
            $indiceAleatorio = rand(0, count($damagePossivel) - 1);
            $damageAleatorio = $damagePossivel[$indiceAleatorio];
            $idCriatura = buscaIdCriatura($criatura, $conn);

            $hp_alvo = subtraiDano($damageAleatorio, $arrayCria['criatura_id'], $conn);
            
            if ($hp_alvo <= 0){
                removeAlvo($arrayCria['criatura_id'], $conn);
                $kill = 1;
            } else{
                $kill = 0;
            }

            $arrayInfo = infoGeral($conn);
            $array_nome_personagem = $arrayInfo['nomePersonagem'];
            $array_hp_personagem = $arrayInfo['hpPersonagem'];
            $array_nome_criatura = $arrayInfo['nomeCriatura'];
            $array_hp_criatura = $arrayInfo['hpCriatura'];

            $quantidade = updateQtd($personagemId, $conn);
            $criatura_nome = $arrayCria['criatura_nome'];

            $resposta['success'] = true;
            $resposta['quantidade'] = $quantidade;
            $resposta['damageAleatorio'] = isset($damageAleatorio) ? $damageAleatorio : '';
            $resposta['criatura'] = $criatura_nome;
            $resposta['array_nome_personagem'] = $array_nome_personagem;
            $resposta['array_nome_criatura'] = $array_nome_criatura;
            $resposta['array_hp_personagem'] = $array_hp_personagem;
            $resposta['array_hp_criatura'] = $array_hp_criatura;
            $resposta['kill'] = $kill;
            $resposta['id_criatura'] = $idCriatura;
    
            $verPersonagem = "SELECT gh.evento as evento, 
            (select x.nome from ganolia_personagem x where x.id = u.personagem_ganolia) as personagem_atual,
            (select x.id from ganolia_personagem x where x.id = u.personagem_ganolia) as id_atual
            FROM ganolia_historico gh 
            INNER join ganolia_personagem gp 
            on gp.id = gh.personagem_id
            INNER JOIN usuarios u
            ON u.id = gp.usuario_id
            WHERE usuario_id = $usuario";
    
            $conHistorico = $conn->query($verPersonagem);
    
            if ($conHistorico == FALSE){
                die("Erro na consulta: " . $conn->error);
            }
    
            $rw = $conHistorico->fetch_assoc();
            $horario = date('Y-m-d H:i:s');
            $idPersonagem = $rw['id_atual'];
            $evento = 'Acertou ' . $damageAleatorio . ' de dano no alvo.';
            $item_usado = $nome;
    
            $inserEvento = "INSERT INTO ganolia_historico
            (personagem_id, evento, horario, item_usado)
            VALUES ($idPersonagem, '$evento', '$horario', '$item_usado')";
    
            if ($conn->query($inserEvento) === FALSE) {
                die("Erro na consulta: " . $conn->error);
            }
        } else{
            $quantidade = updateQtd($personagemId, $conn);
            $arrayCria = buscaCriatura($criatura, $conn);
            $criatura_nome = $arrayCria['criatura_nome'];
            $arrayInfo = infoGeral($conn);
            $array_nome_personagem = $arrayInfo['nomePersonagem'];
            $array_hp_personagem = $arrayInfo['hpPersonagem'];
            $array_nome_criatura = $arrayInfo['nomeCriatura'];
            $array_hp_criatura = $arrayInfo['hpCriatura'];
            $kill = 0;
            $idCriatura = buscaIdCriatura($criatura, $conn);

            $resposta['success'] = true;
            $damageAleatorio = '';
            $resposta['damageAleatorio'] = $damageAleatorio;
            $resposta['quantidade'] = $quantidade;
            $resposta['criatura'] = $criatura_nome;
            $resposta['array_nome_personagem'] = $array_nome_personagem;
            $resposta['array_nome_criatura'] = $array_nome_criatura;
            $resposta['array_hp_personagem'] = $array_hp_personagem;
            $resposta['array_hp_criatura'] = $array_hp_criatura;
            $resposta['kill'] = $kill;
            $resposta['id_criatura'] = $idCriatura;
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
