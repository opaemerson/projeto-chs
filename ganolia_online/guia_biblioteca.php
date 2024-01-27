<?php
include('../protecao.php');
require_once('../config.php');
header('Access-Control-Allow-Origin: *');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Estatisticas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Oswald:wght@300&family=Playfair+Display:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-4">
<a href="index_mecanismo.php">Voltar</a>

<?php
$idUsuario = $_SESSION['id'];

if ($idUsuario){

    $buscar = "SELECT gp.especial_id
    FROM ganolia_personagem gp
    INNER JOIN usuarios u
    ON u.personagem_ganolia = gp.id
    WHERE u.id = $idUsuario";

    $sql = $conn->query($buscar);

    if($sql == FALSE){
        echo "<script>alert('Erro ao buscar dados');</script>";
        echo "<script>window.location.href = 'index_mecanismo.php';</script>";
    }

    $itens = $sql->fetch_assoc();
    $arrayItens = explode(';', $itens['especial_id']);
    $qtdArray = count($arrayItens);

    if($itens['especial_id'] == ''){
      $qtdArray = 0;
    }

    $contando = "SELECT count(0) as contador
    FROM ganolia_item gi
    WHERE gi.especial = 'A'
    AND gi.situacao = 'A'";
    
    $sqlContando = $conn->query($contando);

    if($sqlContando == FALSE){
      echo "<script>alert('Erro ao buscar dados em contador');</script>";
      echo "<script>window.location.href = 'index_mecanismo.php';</script>";
    }

    $busc = $sqlContando->fetch_assoc();
    $contador = $busc['contador'];

    echo "<h3>Você possui $qtdArray itens de $contador</h3>";
    $buscarEquipamento = "SELECT * from ganolia_item gi
    WHERE gi.situacao = 'A'
    AND gi.especial = 'A'
    ORDER BY
     CASE raridade
       WHEN 'Comum' THEN 1
       WHEN 'Incomum' THEN 2
       WHEN 'Magico' THEN 3
       WHEN 'Raro' THEN 4
       WHEN 'Lendario' THEN 5
       ELSE 6
     END,
     gi.ranking DESC;";
  
    $resultado = $conn->query($buscarEquipamento);
    
    if ($resultado) {
    if ($resultado->num_rows > 0) {
        echo '<div class="container">';
        echo '<div class="row">';
        while ($row = $resultado->fetch_assoc()) {
        $codigo = $row['id'];
        $nome = $row['nome'];
        $dados = $row['dados'];
        $valor = $row['valor'];
        $situacao_mercado = $row['situacao_mercado'];
        $raridade = $row['raridade'];
        $damage = $row['damage'];
        $habilidade = $row['habilidade'];
        $taxa_habilidade = $row['taxa_habilidade'];
        $forjar = $row['descricao'];         
        $imagem = $row['imagem'];
        $situacao = $row['situacao'];
        $ranking = $row['ranking'];
        
        $possui = (in_array($codigo, $arrayItens)) ? 'CONQUISTADO' : 'DESCONHECIDO';
  
        $cinzentar = ($possui == 'DESCONHECIDO') ? 'style="filter: grayscale(100%) blur(5px);" ' : '';

        echo '<div class="col-md-3">';
        echo '<div class="card mt-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><img ' . $cinzentar . 'src="' . $imagem . '"  height="200" width="180">';
        if($possui == 'CONQUISTADO'){
          echo '<h5>' . $nome . '</h5>';
        }
        echo '<h6>' . $possui . '</h6>';
        echo '</div>';
        echo '</div>';
        echo '</div>';    
      }
    }
  }
}
?>