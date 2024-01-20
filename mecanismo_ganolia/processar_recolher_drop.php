<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('../config.php');

$criatura = $_POST['criatura'];
$personagemId = (isset($_SESSION['personagem_ganolia']) && $_SESSION['personagem_ganolia']) ? $_SESSION['personagem_ganolia'] : null;

$resposta = array();

function insereMochila($id, $personagemId, $conn){
    $sql = "SELECT gp.mochila as mochila,
    gp.mochila_indice as mochila_indice
    FROM ganolia_personagem gp
    WHERE gp.id = $personagemId";

    $resultado = $conn->query($sql);

    if ($resultado === FALSE) {
        return false;
    }

    $linha = $resultado->fetch_assoc();
    $mochila_antes = $linha['mochila'];
    $indice_antes = $linha['mochila_indice'];

    $arrayIndice = explode(";", $indice_antes);
    $ultimoValor = end($arrayIndice);
    $newValor = $ultimoValor + 1;

    $mochila_agora = $mochila_antes . ";" . $id;
    $indice_agora = $indice_antes . ";" . $newValor;

    $update = "UPDATE ganolia_personagem gp
    SET gp.mochila = '$mochila_agora',
    gp.mochila_indice = '$indice_agora'
    WHERE gp.id = $personagemId";

    $rr = $conn->query($update);

    if($rr === FALSE){
        return false;
    }

    return true;
}

if(isset($criatura) && $criatura !== ''){ 
    $select = "SELECT gc.nome as nome,
     gc.raridade as raridade,
    gc.recompensa_id as recompensa, 
    gc.probabilidade as probabilidade
    FROM ganolia_criatura gc
    WHERE gc.id = '$criatura'";
    $resultado = $conn->query($select);

    if ($resultado->num_rows > 0){
        $linha = $resultado->fetch_assoc();
        $recompensa = $linha['recompensa'];
        $probabilidade = $linha['probabilidade'];
        $recompensaArray = explode(";", $recompensa);
        $probabilidadeArray = explode(";", $probabilidade);
        $guardaId = array();
        $guardaNome = array();
        $guardaRaridade = array();
        $guardaImagem = array();
        foreach ($recompensaArray as $key) {
            $existeItem = "SELECT gi.id, gi.nome, gi.raridade, gi.imagem 
            FROM ganolia_item gi WHERE gi.id = $key";
            
            $resultadoItem = $conn->query($existeItem);
            
            if ($resultadoItem->num_rows == 0) {
                $resposta['message'] = 'Criatura não encontrada.';
            } else {
                $linhaExiste = $resultadoItem->fetch_assoc();
                $guardaId[] = $linhaExiste['id'];
                $guardaNome[] = $linhaExiste['nome'];
                $guardaRaridade[] = $linhaExiste['raridade'];
                $guardaImagem[] = $linhaExiste['imagem'];
            }
        }
        
        $numIndices = count($probabilidadeArray);
        $numeroAleatorio = rand(1, 100);
        
        $intervaloInicial = 0;
        $intervaloFinal = 0;
        
        foreach ($probabilidadeArray as $index => $probabilidade) {
            $intervaloFinal += $probabilidade;
        
            if ($numeroAleatorio <= $intervaloFinal) {
                $recompensaEscolhida = $recompensaArray[$index];
                $idEscolhido = $guardaId[$index];
                $nomeEscolhido = $guardaNome[$index];
                $raridadeEscolhido = $guardaRaridade[$index];
                $imagemEscolhida = $guardaImagem[$index];
                break;
            }
        }

        insereMochila($idEscolhido, $personagemId, $conn);
        
        $resposta['success'] = true;
        $resposta['idEscolhido'] = $idEscolhido;
        $resposta['nomeEscolhido'] = $nomeEscolhido;
        $resposta['raridadeEscolhido'] = $raridadeEscolhido;
        $resposta['numeroAleatorio'] = $numeroAleatorio;
        $resposta['recompensaEscolhida'] = $recompensaEscolhida;
        $resposta['imagemEscolhida'] = $imagemEscolhida;
    } else {
        $resposta['success'] = false;
        $resposta['message'] = 'Criatura não encontrada.';
    }
} else {
    $resposta['success'] = false;
    $resposta['message'] = 'Criatura não encontrada.';
}

$conn->close();
echo json_encode($resposta);
?>
