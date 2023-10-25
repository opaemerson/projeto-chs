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
        $nome = $linha['nome'];
        $raridade = $linha['raridade'];
        $recompensa = $linha['recompensa'];
        $recompensaArray = explode(";", $recompensa);
        $guardaNome = array();
        $guardaImagem = array();
        foreach ($recompensaArray as $key) {
            $existeItem = "SELECT gi.id, gi.imagem FROM ganolia_item gi WHERE gi.id = $key";
            $resultadoItem = $conn->query($existeItem);
            
            if ($resultadoItem->num_rows == 0) {
                $resposta['message'] = 'Imagem não encontrada.';
            } else {
                $linhaExiste = $resultadoItem->fetch_assoc();
                // $guardaNome[] = $linhaExiste
                $guardaImagem[] = $linhaExiste['imagem'];
            }
        }
        
        $resposta['success'] = true;
        $resposta['nome'] = $nome;
        $resposta['raridade'] = $raridade;
        if (isset($guardaImagem[0])) {
            $resposta['imagem1'] = $guardaImagem[0];
        } else {
            $resposta['imagem1'] = '';
        }
        if (isset($guardaImagem[1])) {
            $resposta['imagem2'] = $guardaImagem[1];
        } else {
            $resposta['imagem2'] = '';
        }
        if (isset($guardaImagem[2])) {
            $resposta['imagem3'] = $guardaImagem[2];
        } else {
            $resposta['imagem3'] = '';
        }
        if (isset($guardaImagem[3])) {
            $resposta['imagem4'] = $guardaImagem[3];
        } else {
            $resposta['imagem4'] = '';
        }
        if (isset($guardaImagem[4])) {
            $resposta['imagem5'] = $guardaImagem[4];
        } else {
            $resposta['imagem5'] = '';
        }
        
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
