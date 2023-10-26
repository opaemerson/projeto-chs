<?php
require_once('../config.php');
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
<div class="container mt-5">
<h3>Itens de Material</h3>

  <?php
        $itemMaterial = "SELECT * FROM ganolia_item gi WHERE gi.categoria = 'Material'";
        $resultado = $conn->query($itemMaterial);

        if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
        $id = $row["id"];   
        $nome = $row["nome"];
        $tipo = $row["tipo"];
        $raridade = $row["raridade"];
        $descricao = $row["descricao"];

        $imagem = $row['imagem'];

        echo '<div class="row mt-3">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo "<h5 class='card-title'>$nome</h5>";
        echo "<h6 class='card-subtitle mb-2 text-muted'>Tipo: $tipo</h6>";
        echo "<p class='card-text'>Raridade: $raridade</p>";
        echo "<img src='$imagem' class='img-enviado' width='30' height='30' >";
        echo "<p class='card-text'>Descricao: $descricao</p>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        }
    }
    ?>
      <br><br>
<a href="./index_mecanismo.php" type="button" class="btn-preto">Voltar</a>
</body>
</html>
