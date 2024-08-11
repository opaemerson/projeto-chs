<?php
include('../protecao.php');
require_once('../config.php');
require_once('classes/servicoPrincipal.php');

$config = new Config();
$servico = new Servico();

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
</head>
<body>
  <label for=""><b>Quantidade pela Categoria - Problemas</b></label>
    <?php
      $arrayProblemas = $servico->buscaGenerica('a.problema, count(a.problema) as quantidade', 'chs_controle a', 'GROUP BY a.problema');

      foreach($arrayProblemas as $problema){
        $nome = $problema["problema"];
        $quantidade = $problema["quantidade"];
        echo "<br> Problema: $nome - Quantidade: $quantidade ";
      }

      ?>
      <br><label for=""><b>Quantidade pela Categoria - Marcas</b></label>

      <?php
      $arrayMarcas = $servico->buscaGenerica('a.modelo, count(a.modelo) as quantidade', 'chs_controle a', 'GROUP BY a.modelo');

      foreach($arrayMarcas as $marca){
        $nome = $marca["modelo"];
        $quantidade = $marca["quantidade"];
        echo "<br> Marca: $nome - Quantidade: $quantidade ";
      }

      ?>
      <br><label for=""><b>Quantidade pela Categoria - Situacao</b></label>

      <?php

      $arraySituacoes = $servico->buscaGenerica('a.situacao, count(a.situacao) as quantidade', 'chs_controle a', 'GROUP BY a.situacao');

      foreach($arraySituacoes as $situacao){
        $nome = $situacao["situacao"];
        $quantidade = $situacao["quantidade"];
        echo "<br> Situação: $nome - Quantidade: $quantidade ";
      }

      ?>
  <br>
<a href="adm.php" type="button" class="btn-preto">Voltar</a>
</body>
</html>
