<?php
require_once('../config.php');

$procurarAtaque = "SELECT * FROM ganolia_item gi";

if (isset($_POST['pesquisar'])) {
    $palavra = $_POST['palavra'];
    $procurarAtaque .= " WHERE gi.nome LIKE '%$palavra%'";
}

if (isset($_POST['filtrar_categoria'])) {
  $categoriaSelecionada = $_POST['categoria'];
  if (!empty($categoriaSelecionada)) {
      $procurarAtaque .= " WHERE gi.categoria = '$categoriaSelecionada'";
  }
}

if (isset($_POST['filtrar_tipo'])) {
  $tipoSelecionada = $_POST['tipo'];
  if (!empty($tipoSelecionada)) {
      $procurarAtaque .= " WHERE gi.tipo = '$tipoSelecionada'";
  }
}

$resultadoProcurar = $conn->query($procurarAtaque);
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
  <script>
  function pegarPalavra() {
    var palavra = document.getElementById('palavra').value;

    console.log('Valor da variável palavra:', palavra);
    }

    function limpar() {
    var randomValue = new Date().getTime();
    var currentUrl = window.location.href;
    var newUrl = currentUrl + "?random=" + randomValue;
    window.location.href = newUrl;
}

  </script>

</head>
<body>
<div class="container mt-5">
<h3>Procure por algo</h3>

<form method="POST">
  <input type="text" style="width: 220px;" name="palavra" id="palavra">
  <button type="submit" name="pesquisar">Pesquisar</button>
</form>

<br>
<form method="POST">
  <select name="categoria" id="categoria">
    <option value="">Selecione uma categoria</option>
    <?php
    $selectOpcoes = "SELECT DISTINCT gi.categoria FROM ganolia_item gi";
    $resultadoOpcoes = $conn->query($selectOpcoes);
    if ($resultadoOpcoes) {
        while ($rowOp = $resultadoOpcoes->fetch_assoc()) {
            $categoria = $rowOp['categoria'];
            echo "<option value='$categoria'>$categoria</option>";
        }
        $resultadoOpcoes->close();
    } else {
        echo "Erro na consulta sql";
    }
    ?>
  </select>
  <button type="submit" name="filtrar_categoria">Filtrar por Categoria</button>
</form>

<br>
<form method="POST">
  <select name="tipo" id="tipo">
    <option value="">Selecione uma tipo</option>
    <?php
    $selectTipos = "SELECT DISTINCT gi.tipo FROM ganolia_item gi";
    $resultadoTipos = $conn->query($selectTipos);
    if ($resultadoTipos) {
        while ($rowTp = $resultadoTipos->fetch_assoc()) {
            $tipo = $rowTp['tipo'];
            echo "<option value='$tipo'>$tipo</option>";
        }
        $resultadoTipos->close();
    } else {
        echo "Erro na consulta sql";
    }
    ?>
  </select>
  <button type="submit" name="filtrar_tipo">Filtrar por tipo</button>
</form>

<br>
<form action="POST">
<button type="button" onclick="limpar()">Limpar</button>
</form>

<?php
if (isset($_POST['pesquisar']) || isset($_POST['todos']) || isset($_POST['filtrar_categoria']) || isset($_POST['filtrar_tipo'])) {
while ($row = $resultadoProcurar->fetch_assoc()) {
    $id = $row["id"];
    $nome = $row["nome"];
    $tipo = $row["tipo"];
    $raridade = $row["raridade"];
    $damage = $row["damage"];
    $imagem = $row['imagem'];

    if ($damage != '' || $damage != null) {
        $damagePossivel = explode(";", $damage);
        $damageVisual = $damagePossivel[0] . " - " . $damagePossivel[count($damagePossivel) - 1];
    }

    echo '<div class="card mt-3">';
    echo '<div class="card-body">';
    echo "<h5 class='card-title'>$nome</h5>";
    echo "<h6 class='card-subtitle mb-2 text-muted'>Tipo: $tipo</h6>";
    echo "<p class='card-text'>Raridade: $raridade</p>";
    echo "<p class='card-text'>Dano possivel: " . (isset($damageVisual) ? $damageVisual : '-') . "</p>";
    echo "<img src='$imagem' class='img-enviado' width='30' height='30' alt='Imagem do item'>";
    echo '</div>';
    echo '</div>';
  }
}
?>
<br><br>
<a href="./index_mecanismo.php" type="button" class="btn-preto">Voltar</a>
</body>
</html>
