<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

function buscaImagem($ataques, $conn){
    $quebraAtaque = explode(";", $ataques);
    $imagens = '';

    foreach($quebraAtaque as $att){
        $sqlImagem = "SELECT
        gi.imagem as imagem
        FROM ganolia_item gi
        WHERE gi.id = $att";

        $conexao = $conn->query($sqlImagem);

        if ($conexao === FALSE) {
            continue;
        } else {
            $lita = $conexao->fetch_assoc();
            $img = $lita['imagem'];
            $imagens = $imagens . $img . ";";
        }
    }
    
    return $imagens;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ativo = $_POST['ativado'];

    if($ativo == 1){
        $buscaDados = "SELECT
        gst.ataque_ativo as ataque_ativo,
        gst.qtd_ataque as qtd_atq,
        gs.personagem_id as criatura,
        gs.row,
        gs.col
        FROM ganolia_sessao gs
        LEFT JOIN ganolia_sessao_tmp gst
        ON gst.personagem_id = gs.personagem_id
        WHERE gs.personagem_id = $personagemId";
        
        $resultado = $conn->query($buscaDados);

        if ($resultado === FALSE) {
            echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
        }

        $row = $resultado->fetch_assoc();
        $quantidade = $row['qtd_atq'];
        $ataques = $row['ataque_ativo'];

        if(!empty($ataques) || $ataques !== ''){
            $img = buscaImagem($ataques, $conn);
        }

        $rowJogador = intval($row['row']);
        $colJogador = intval($row['col']);        

        $arrayCoordenadas = [
            0 => [
                "row" => $rowJogador,
                "col" => $colJogador
            ],
            1 => [
                "row" => $rowJogador + 1,
                "col" => $colJogador
            ],
            2 => [
                "row" => $rowJogador + 2,
                "col" => $colJogador
            ],
            3 => [
                "row" => $rowJogador - 1,
                "col" => $colJogador
            ],
            4 => [
                "row" => $rowJogador - 2,
                "col" => $colJogador
            ],
            5 => [
                "row" => $rowJogador,
                "col" => $colJogador + 1
            ],
            6 => [
                "row" => $rowJogador,
                "col" => $colJogador + 2
            ],
            7 => [
                "row" => $rowJogador,
                "col" => $colJogador - 1
            ],
            8 => [
                "row" => $rowJogador,
                "col" => $colJogador - 2
            ]
        ];
        

        $sqlCriatura = "SELECT gs.row as row_criatura,
        gs.col as col_criatura,
        gc.nome as nome_criatura
        FROM ganolia_sessao gs
        INNER JOIN ganolia_criatura gc
        ON gc.id = gs.criatura_id
        WHERE gs.personagem_id = 99";
        
        $rr = $conn->query($sqlCriatura);
        
        if ($rr === FALSE) {
            echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
        }

        if ($rr->num_rows > 0) {
            $criaDisponivel = [];
            
            while ($linha = $rr->fetch_assoc()) {
                $rowCriatura = intval($linha['row_criatura']);
                $colCriatura = intval($linha['col_criatura']);
        
                foreach ($arrayCoordenadas as $coordenada) {
                    $rowOffset = $coordenada['row'];
                    $colOffset = $coordenada['col'];
                
                    if ($rowCriatura == $rowOffset && $colCriatura == $colOffset) {
                        // Adicione os dados relevantes ao array $criaDisponivel se as coordenadas existirem no arrayCordenadas
                        $criaDisponivel[] = array(
                            'row' => $rowCriatura,
                            'col' => $colCriatura,
                            'nome_criatura' => $linha['nome_criatura']
                        );
                        break; // Se encontrou uma correspond�ncia, pode sair do loop, se desejar armazenar todas as correspond�ncias, remova este break
                    }
                }                
            }
        }    
        $resposta['success'] = true;
        $resposta['quantidade'] = isset($quantidade) ? $quantidade : '';
        $resposta['ataques'] = isset($ataques) ? $ataques : '';
        $resposta['nome_criatura'] = isset($criaDisponivel) ? $criaDisponivel : '';
        $resposta['imagens'] = isset($img) ? $img : '';

        echo json_encode($resposta);
    }
    else {
        echo json_encode(array("success" => false, "message" => "Erro ao busca itens de ataque: " . $conn->error));
    }

    $conn->close();
} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>