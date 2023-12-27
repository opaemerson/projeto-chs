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
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    margin: 0;
}

section {
    padding: 25px 5%;
    border-bottom: 1px solid #ccc;
    text-align: left;
}


section h2{
    font-size: 1em;
    margin-bottom: 10px;
}

section p{
    font-size: 20px;
    text-align: left;
}
</style>
</head>

<body>
<a href="./index_mecanismo.php" type="button" class="btn btn-danger">Voltar</a>
<section>
<h4>Territorios Ativos</h4>
<p><b>Pantano Flutuante</b>: Local de drop itens diversas</p>
<p><b>Floresta Oculta</b>: Local de drop itens diversas, alguns itens de plantas</p>
<p><b>Skulles</b>: Local de drop itens diversas, alguns itens de osso</p>
<p><b>Vale da Lua</b>: Local de drop itens diversas, alguns itens brancos</p>
<p><b>Pedras de Fogo</b>: Local de drop itens diversas, itens vermelhos, fogo</p>
<p><b>Iceborg</b>: Local de drop itens de gelo.</p>
<p><b>Draconia</b>: Local de drop itens de dragoes</p>
<p><b>Koppala</b>: Local de drop itens fortes</p>
</section>

<section>
<h4>Territorios Inativos</h4>
<p><b>Deserto de Xantras</b>: Local de drop itens diversas, alguns itens egipicios</p>
<p><b>Prisma</b>: Local de drop itens diferentes</p>
<p><b>Orkland</b>: Local de drop itens diversas.</p>
<p><b>Obscuria</b>: Local de drop itens tipo obsidiana</p>
</section>


<div class="container mt-4">
<h3>Criaturas por território</h3>
  <?php
  $buscarCriaturas = "SELECT c.id AS criatura_id, 
                      c.nome as criatura_nome,
                      c.recompensa_id,
                      c.territorio as criatura_territorio,
                      c.probabilidade,
                      c.imagem
                      FROM ganolia_criatura c
                      order by c.territorio";

  $resultado = $conn->query($buscarCriaturas);

  if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $criatura_territorio = $row['criatura_territorio'];
            $criatura_nome = $row['criatura_nome'];
            $criatura_id = $row['criatura_id'];
            $recompensa_id = $row['recompensa_id'];
            $probabilidade = $row['probabilidade'];
            $imagem = $row['imagem'];

            $quebrandoRecompensa = explode(";", $recompensa_id);
            $quebrandoProbabilidade = explode(";", $probabilidade);
            
            $guardarNome = array();
            foreach ($quebrandoRecompensa as $key => $recompensa) {
                $buscarNomeRecompensa = "SELECT gi.nome, gi.tipo FROM ganolia_item gi WHERE gi.id = $recompensa";
                $resultadoNomeRecompensa = $conn->query($buscarNomeRecompensa);
            
                if ($resultadoNomeRecompensa) {
                    if ($resultadoNomeRecompensa->num_rows > 0) {
                        while ($rowNomeRecompensa = $resultadoNomeRecompensa->fetch_assoc()) {
                            $nomeRecompensa = $rowNomeRecompensa['nome'];
                            $porcentagem = $quebrandoProbabilidade[$key];
            
                            $guardarNome[] = "<b>" . $nomeRecompensa . "</b>[" . $porcentagem . "%] ";
                        }
                    } else {
                        echo "Nao encontrou nome do item";
                    }
                }
            }
            $nomesRecompensa = implode(", ", $guardarNome);
            echo '<div class="card mt-3">';
            echo '<div class="card-body">';
            echo "<h5 class='card-title'>$criatura_territorio</h5>";
            echo "<h6 class='card-subtitle mb-2 text-muted'>Criatura Nome: $criatura_nome</h6>";
            echo '<h5 class="card-title"><img src="' . $imagem . '"  height="200" width="180">';
            echo "<p class='card-text'>Possiveis Recompensa: $nomesRecompensa</p>";
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Nenhum registro encontrado.";
    }
} else {
    echo "Erro na consulta SQL: " . $conn->error;
}
  ?>
  </div>


</div>
</body>

</html>