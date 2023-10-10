<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Estatisticas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Oswald:wght@300&family=Playfair+Display:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body>
  <label for=""><b>Quantidade pela Categoria - Problemas</b></label>
  <?php
      $problema = "SELECT problema, count(problema) as quantidade FROM heads GROUP BY problema";
      $resultado = $conn->query($problema);
      if ($resultado->num_rows > 0){
        while ($row = $resultado->fetch_assoc()) {
          $problema = $row["problema"];
          $quantidade = $row["quantidade"];
          echo "<br> Problema: $problema - Quantidade: $quantidade ";
      }
      } else{
          echo "nao ha dados.";
      }
      ?>
            <br>
            <label for=""><b>Quantidade pela Categoria - Marcas</b></label>

      <?php

      $marca = "SELECT modelo, count(modelo) as quantidade_marca FROM heads GROUP BY modelo";
      $resultado_marca = $conn->query($marca);
      if ($resultado_marca->num_rows > 0){
        while ($row = $resultado_marca->fetch_assoc()) {
          $marca = $row["modelo"];
          $quantidade_marca = $row["quantidade_marca"];
          echo "<br> Marca: $marca - Quantidade: $quantidade_marca ";
      }
      } else{
        echo "nao ha dados.";
      }

      ?>
      <br>
      <label for=""><b>Quantidade pela Categoria - Situacao</b></label>

      <?php

      $situacao = "SELECT situacao, count(situacao) as quantidade_situacao FROM heads GROUP BY situacao";
      $resultado_situacao = $conn->query($situacao);
      if ($resultado_situacao->num_rows > 0){
        while ($row = $resultado_situacao->fetch_assoc()) {
          $situacao = $row["situacao"];
          $quantidade_situacao = $row["quantidade_situacao"];
          echo "<br> Situacao: $situacao - Quantidade: $quantidade_situacao ";
      }
      } else{
        echo "nao ha dados.";
      }
  ?>
  <br>
<a href="index.php" type="button" class="btn-preto">Voltar</a>
</body>
</html>
