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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-4">
<a href="adm.php">Voltar</a>
<h3>Espadas </h3>
<?php
  $buscarEquipamento = "SELECT * from ganolia_item gi
  WHERE gi.tipo = 'Espada'
  AND gi.situacao = 'I'
  ORDER BY
   CASE raridade
     WHEN 'Comum' THEN 1
     WHEN 'Incomum' THEN 2
     WHEN 'Raro' THEN 3
     WHEN 'Lendario' THEN 4
     ELSE 5 
   END;";

$resultado = $conn->query($buscarEquipamento);

if ($resultado) {
if ($resultado->num_rows > 0) {
    echo '<div class="container">';
    echo '<div class="row">';
    while ($row = $resultado->fetch_assoc()) {
    $nome = $row['nome'];
    $categoria = $row['categoria'];
    $raridade = $row['raridade'];
    $damage = $row['damage'];
    $habilidade = $row['habilidade'];
    // $taxa_habilidade = $row['taxa_habilidade'];
    $imagem = $row['imagem'];

        echo '<div class="col-md-3">';
        echo '<div class="card mt-4">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><img src="' . $imagem . '"  height="200" width="180">' . $nome . '</h5>';
        echo "<h6 class='card-subtitle mb-2 text-muted'>Raridade: $raridade</h6>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        }
    }
} else {
echo "Nenhum registro encontrado.";
}
?>

