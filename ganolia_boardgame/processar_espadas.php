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
    $id = $_POST['idEspada'];
    $nomeEspada = $_POST['nomeEspada'];
    $raridade = $_POST['nomeRaridade'];
    $dados = $_POST['nomeDados'];
    $damage = $_POST['nomeDamage'];
    $habilidade = $_POST['nomeHabilidade'];
    $taxaHabilidade = $_POST['nomeTaxahabilidade'];
    $situacaoMercado = $_POST['situacaoMercado'];
    $valor = $_POST['valor'];
    $forjar = $_POST['forjar'];
    $especial = empty($row['especial']) ? $row['especial'] : '';
    $ranking = $_POST['ranking'];
    $situacao = $_POST['situacao'];
    $imagem = $_POST['imagem'];

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
        descricao = '$forjar',
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
