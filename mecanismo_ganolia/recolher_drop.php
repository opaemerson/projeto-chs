<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('../config.php');

$idCriatura = $_POST['idCriatura'];

$resposta = array();

if(isset($idCriatura) && $idCriatura !== ''){ 
    $select = "SELECT gc.nome as nome, gc.raridade as raridade, gv.recompensa_id as recompensa, gv.probabilidade as probabilidade
    FROM ganolia_vinculo gv
    INNER JOIN ganolia_criatura gc
    ON gc.id = gv.criatura_id
    WHERE gc.id = '$idCriatura'";
    $resultado = $conn->query($select);

    if ($resultado->num_rows > 0){
        $linha = $resultado->fetch_assoc();
        $recompensa = $linha['recompensa'];
        $probabilidade = $linha['probabilidade'];
        $recompensaArray = explode(";", $recompensa);
        $probabilidadeArray = explode(";", $probabilidade);
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
                $nomeEscolhido = $guardaNome[$index];
                $raridadeEscolhido = $guardaRaridade[$index];
                $imagemEscolhida = $guardaImagem[$index];
                break;
            }
        }
        
        $resposta['success'] = true;
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
