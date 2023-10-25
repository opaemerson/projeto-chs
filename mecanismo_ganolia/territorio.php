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
  <label for=""><h3>Territorios</h3></label>
  <?php
        $territorio = "SELECT 
        territorio, 
        GROUP_CONCAT(CONCAT('Nome: ' ,nome, ' [', raridade, '] - Drops: [', nome_recompensa, ']') SEPARATOR '<br>') as detalhes, 
        COUNT(*) as quantidade 
        FROM ganolia_criatura 
        GROUP BY territorio";

        $resultado = $conn->query($territorio);

        if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
        $territorio = $row["territorio"];
        $quantidade = $row["quantidade"];
        $detalhes = $row["detalhes"];
        echo "<br><br> <b>Territorio:</b> $territorio <br>Quantidade de criaturas: $quantidade";

        if (!empty($detalhes)) {
        echo "<br> Detalhes das Criaturas:" . "<br> $detalhes";
        } else {
        echo "<br> Nenhum nome encontrado para este territorio.";
        }
    }
        } else {
        echo "Não há dados.";
        }
      ?>
      <br><br>
<a href="./index_mecanismo.php" type="button" class="btn-preto">Voltar</a>
</body>
</html>
