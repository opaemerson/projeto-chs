<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('../config.php');

$idCriatura = $_POST['idCriatura'];

$resposta = array();

if(isset($idCriatura) && $idCriatura !== ''){ 
    $select = "SELECT gc.nome as nome, gc.raridade as raridade, gc.recompensa_id as recompensa, gc.probabilidade as probabilidade
    FROM ganolia_criatura gc
    WHERE gc.id = '$idCriatura'";
    $resultado = $conn->query($select);

    if ($resultado->num_rows > 0){
        $linha = $resultado->fetch_assoc();
        $nome = $linha['nome'];
        $raridade = $linha['raridade'];
        $recompensa = $linha['recompensa'];
        $recompensaArray = explode(";", $recompensa);
        $guardaNome = array();
        $guardaRaridade = array();
        $guardaImagem = array();
        foreach ($recompensaArray as $key) {
            $existeItem = "SELECT gi.id, gi.nome, gi.raridade as item_raridade,
            gi.imagem FROM ganolia_item gi WHERE gi.id = $key";
            $resultadoItem = $conn->query($existeItem);
            
            if ($resultadoItem->num_rows == 0) {
                $resposta['message'] = 'Imagem não encontrada.';
            } else {
                $linhaExiste = $resultadoItem->fetch_assoc();
                $guardaNome[] = $linhaExiste['nome'];
                $guardaRaridade[] = $linhaExiste['item_raridade'];
                $guardaImagem[] = $linhaExiste['imagem'];
            }
        }
        
        $resposta['success'] = true;
        $resposta['nome'] = $nome;
        $resposta['raridade'] = $raridade;

        if (isset($guardaRaridade[0])) {
            $resposta['item_raridade1'] = $guardaRaridade[0];
        } else {
            $resposta['item_raridade1'] = '';
        }
        if (isset($guardaRaridade[1])) {
            $resposta['item_raridade2'] = $guardaRaridade[1];
        } else {
            $resposta['item_raridade2'] = '';
        }
        if (isset($guardaRaridade[2])) {
            $resposta['item_raridade3'] = $guardaRaridade[2];
        } else {
            $resposta['item_raridade3'] = '';
        }
        if (isset($guardaRaridade[3])) {
            $resposta['item_raridade4'] = $guardaRaridade[3];
        } else {
            $resposta['item_raridade4'] = '';
        }

        //verificando nome dos drops
        if (isset($guardaNome[0])) {
            $resposta['nome1'] = $guardaNome[0];
        } else {
            $resposta['nome1'] = '';
        }
        if (isset($guardaNome[1])) {
            $resposta['nome2'] = $guardaNome[1];
        } else {
            $resposta['nome2'] = '';
        }
        if (isset($guardaNome[2])) {
            $resposta['nome3'] = $guardaNome[2];
        } else {
            $resposta['nome3'] = '';
        }
        if (isset($guardaNome[3])) {
            $resposta['nome4'] = $guardaNome[3];
        } else {
            $resposta['nome4'] = '';
        }

        //verificando imagens dos drops   
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
