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
  <label for=""><h3>Itens de Ataque</h3></label>

  <?php
        $itemAtaque = "SELECT * FROM ganolia_item";
        $resultado = $conn->query($itemAtaque);

        if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
        $id = $row["id"];   
        $nome = $row["nome"];
        $tipo = $row["tipo"];
        $raridade = $row["raridade"];
        $damage = $row["damage"];

        if ($damage != '' || $damage != null){
            $damagePossivel = explode(";", $damage);
            $damageVisual = $damagePossivel[0] . " - " . $damagePossivel[count($damagePossivel) - 1];
        }

        echo "<br> $nome" . "<br> Dano possivel: " . $damageVisual . "<br>";
        }
    }
    ?>
      <br><br>
<a href="./index_mecanismo.php" type="button" class="btn-preto">Voltar</a>


</body>
</html>