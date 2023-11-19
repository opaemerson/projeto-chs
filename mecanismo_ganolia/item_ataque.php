<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once('../config.php');

$codigoItemAtaque = $_POST['codigoItemAtaque'];

$resposta = array();

if(isset($codigoItemAtaque) && $codigoItemAtaque !== ''){ 
    $select = "SELECT * FROM ganolia_item 
    WHERE id = '$codigoItemAtaque' 
    AND categoria = 'Ataque'
    AND situacao = 'A'";
    $resultado = $conn->query($select);

    if ($resultado->num_rows > 0){
        $linha = $resultado->fetch_assoc();
        $nome = $linha['nome'];
        $tipo = $linha['tipo'];
        $raridade = $linha['raridade'];
        $imagem = $linha['imagem'];
        $damage = $linha['damage'];
        $habilidade = $linha['habilidade'];

        if ($damage != '' || $damage != null){
            $damage = $linha['damage'];
            $damagePossivel = explode(";", $damage);
            $damageVisual = $damagePossivel[0] . " - " . $damagePossivel[count($damagePossivel) - 1];
        }

        switch ($habilidade) {
            case "Critico":
                break;
            case "Vampirismo":
                break;
            default:
                break;
        }
        
        $resposta['success'] = true;
        $resposta['nome'] = $nome;
        $resposta['tipo'] = $tipo;
        $resposta['raridade'] = $raridade;
        if (isset($damageVisual)) {
            $resposta['damageVisual'] = $damageVisual;
        } else {
            $resposta['damageVisual'] = '';
        }
        $resposta['imagem'] = $imagem;
    } else {
        $resposta['success'] = false;
        $resposta['message'] = 'Item não pertence a categoria de Ataque.';
    }
} else {
    $resposta['success'] = false;
    $resposta['message'] = 'Código do item não fornecido.';
}

$conn->close();
echo json_encode($resposta);
?>


<div class="modal fade" id="modalColetivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Importar Arquivo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="processar_upload.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="data_envio" class="form-control">
        <input type="hidden" id="previsao" class="form-control">
        <input type="hidden" id="retorno" class="form-control">
        <input type="hidden" id="garantia" class="form-control">
        <div class="mb-3">
            <label for="arquivo">Selecione um arquivo:</label>
            <input type="file" id="arquivo" name="arquivo">
        </div>
        <button type="submit" class="btn btn-primary" value="cadastrar">Enviar</button>
        </form>
    </div>
    </div>
</div>
</div>