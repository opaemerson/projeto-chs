<?php
require_once('../config.php');

function buscaTerritorio($codigo) {
  global $conn;
  $arrayResultado = array();

  try {
      $buscarCriatura = "SELECT * FROM ganolia_criatura gc WHERE recompensa_id LIKE '%$codigo%'";

      $result = $conn->query($buscarCriatura);

      if ($result === false) {
          echo "Erro na consulta: " . $conn->error;
      } else {
          while ($row = $result->fetch_assoc()) {
              if (isset($row['recompensa_id'])) {
                  $nomeTerritorio = $row['territorio'];
                  $recompensa_id = $row['recompensa_id'];
                  $partes = explode(";", $recompensa_id);

                  foreach ($partes as $parte) {
                      if ($parte === $codigo) {
                          $arrayResultado[] = $nomeTerritorio;
                      }
                  }
              }
          }
      }

      return $arrayResultado;
  } catch (Exception $e) {
      echo "Exceção capturada: " . $e->getMessage();
  }
}



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
<h3>Espadas Inativas</h3>
<?php
  $buscarEquipamento = "SELECT * from ganolia_item gi
  WHERE gi.tipo = 'Espada'
  AND gi.situacao = 'I'
  ORDER BY
   CASE raridade
     WHEN 'Comum' THEN 1
     WHEN 'Incomum' THEN 2
     WHEN 'Magico' THEN 3
     WHEN 'Raro' THEN 4
     WHEN 'Lendario' THEN 5
     ELSE 6
   END;";

$resultado = $conn->query($buscarEquipamento);

if ($resultado) {
if ($resultado->num_rows > 0) {
    echo '<div class="container">';
    echo '<div class="row">';
    while ($row = $resultado->fetch_assoc()) {
    $codigo = $row['id'];
    $nome = $row['nome'];
    $dados = $row['dados'];
    $raridade = $row['raridade'];
    $damage = $row['damage'];
    $habilidade = $row['habilidade'];
    $taxa_habilidade = $row['taxa_habilidade'];         
    $imagem = $row['imagem'];
    $territorio = buscaTerritorio ($codigo);

        echo '<div class="col-md-3">';
        echo '<div class="card mt-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title"><img src="' . $imagem . '"  height="200" width="180">' . $nome . '</h5>';
        if ($raridade == 'Comum') {
          echo "<h6>$raridade " . '<img src="../Images/Ganolia/Icons/Comum.png" width="20" height="20">' . "</h6>";
        }
        elseif($raridade == 'Incomum'){
          echo "<h6>$raridade " . '<img src="../Images/Ganolia/Icons/Incomum.png" width="20" height="20">' . "</h6>";
        }
        elseif($raridade == 'Magico'){
          echo "<h6>$raridade " . '<img src="../Images/Ganolia/Icons/Magico.png" width="20" height="20">' . "</h6>";
        }  
        elseif($raridade == 'Raro'){
          echo "<h6>$raridade " . '<img src="../Images/Ganolia/Icons/Raro.png" width="20" height="20">' . "</h6>";
        }  
        elseif($raridade == 'Lendario'){
          echo "<h6>$raridade " . '<img src="../Images/Ganolia/Icons/Lendario.png" width="20" height="20">' . "</h6>";
        }
        echo "<h6>Dados: $dados</h6>";
        echo "<h6>Damage: $damage</h6>";
        echo "<h6>Habilidade: $habilidade</h6>";
        echo "<h6>Taxa Hab: $taxa_habilidade</h6>";
        foreach ($territorio as $nomesTerritorios){
          echo "<h6>Territorio: $nomesTerritorios</h6>";
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        }
    }
} else {
echo "Nenhum registro encontrado.";
}
?>

