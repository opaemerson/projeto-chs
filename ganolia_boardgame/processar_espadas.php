<?php
include('../protecao.php');
require_once('../config.php');
header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
    $id = isset($_POST['idEspada']) ? $_POST['idEspada'] : null;
    $nomeEspada = isset($_POST['nomeEspada']) ? $_POST['nomeEspada'] : null;
    $raridade = isset($_POST['nomeRaridade']) ? $_POST['nomeRaridade'] : null;
    $dados = isset($_POST['nomeDados']) ? $_POST['nomeDados'] : null;
    $damage = isset($_POST['nomeDamage']) ? $_POST['nomeDamage'] : null;
    $habilidade = isset($_POST['nomeHabilidade']) ? $_POST['nomeHabilidade'] : null;
    $taxaHabilidade = isset($_POST['nomeTaxahabilidade']) ? $_POST['nomeTaxahabilidade'] : null;
    $situacaoMercado = isset($_POST['situacaoMercado']) ? $_POST['situacaoMercado'] : null;
    $valor = isset($_POST['valor']) ? $_POST['valor'] : null;
    $acc = isset($_POST['acc']) ? $_POST['acc'] : null;    
    $especial = isset($_POST['especial']) ? $_POST['especial'] : '';
    $ranking = isset($_POST['ranking']) ? $_POST['ranking'] : null;
    $situacao = isset($_POST['situacao']) ? $_POST['situacao'] : null;
    $imagem = isset($_POST['imagem']) ? $_POST['imagem'] : null;

    if (empty($id)) {
        echo "<script>alert('Campo idEspada esta vazio');</script>";
    } else {
        $update = "UPDATE ganolia_item
        SET nome = '$nomeEspada',
        raridade = '$raridade',
        dados = '$dados',
        damage = '$damage',
        habilidade = '$habilidade',
        taxa_habilidade = '$taxaHabilidade',
        situacao_mercado = '$situacaoMercado',
        valor = '$valor',
        acc = '$acc',
        especial = '$especial',
        ranking = '$ranking',
        situacao = '$situacao',
        imagem = '$imagem'
        WHERE id = $id";

        if ($conn->query($update) === TRUE) {
            echo "<script>alert('Sucesso!');</script>";
            echo "<script>window.location.href = 'adm_espada.php';</script>"; 
        } else {
            echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
        }
    }
}
   ?>
   
</body>
