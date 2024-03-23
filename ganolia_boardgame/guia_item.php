<?php
require_once('../config.php');

$procurarAtaque = "SELECT * FROM ganolia_item gi";
$condicoes = "";

if (isset($_POST['pesquisar'])) {
    $palavra = $_POST['palavra'];
    $condicoes .= "AND (gi.nome LIKE '%$palavra%' OR gi.id LIKE '%$palavra%')";
}

if (isset($_POST['filtrar'])) {
  $categoriaSelecionada = isset($_POST['categoria']) ? $_POST['categoria'] : '';
  $tipoSelecionada = isset($_POST['tipo']) ? $_POST['tipo'] : '';
  $raridadeSelecionada = isset($_POST['raridade']) ? $_POST['raridade'] : '';
  if (!empty($categoriaSelecionada)) {
      $condicoes .= "AND gi.categoria = '$categoriaSelecionada'";
  }
  if (!empty($tipoSelecionada)) {
      $condicoes .= "AND gi.tipo = '$tipoSelecionada'";
  }
  if (!empty($raridadeSelecionada)) {
    $condicoes .= "AND gi.raridade = '$raridadeSelecionada'";
  }
}

$condicoes = ltrim($condicoes, "AND");

if (!empty($condicoes)) {
  $procurarAtaque .= " WHERE" . $condicoes;
}

$resultadoProcurar = $conn->query($procurarAtaque);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/ganolia_boardgame/guia_personagem.css">
  <title>Estatisticas</title>
<script>
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
<h3>Procure por item</h3>

<form method="POST">
  <input type="text" style="width: 300px; height: 30px;" name="palavra" id="palavra" placeholder="Digite o ID ou NOME da Criatura">
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
  <br><br>
  <select name="tipo" id="tipo">
    <option value="">Selecione um tipo</option>
    <?php
    $selectOpcoes = "SELECT DISTINCT gi.tipo FROM ganolia_item gi";
    $resultadoOpcoes = $conn->query($selectOpcoes);
    if ($resultadoOpcoes) {
        while ($rowOp = $resultadoOpcoes->fetch_assoc()) {
            $tipo = $rowOp['tipo'];
            echo "<option value='$tipo'>$tipo</option>";
        }
        $resultadoOpcoes->close();
    } else {
        echo "Erro na consulta sql";
    }
    ?>
  </select>
  <br><br>
  <select name="raridade" id="raridade">
    <option value="">Selecione uma raridade</option>
    <?php
    $selectOpcoes = "SELECT DISTINCT gi.raridade FROM ganolia_item gi";
    $resultadoOpcoes = $conn->query($selectOpcoes);
    if ($resultadoOpcoes) {
        while ($rowOp = $resultadoOpcoes->fetch_assoc()) {
            $raridade = $rowOp['raridade'];
            echo "<option value='$raridade'>$raridade</option>";
        }
        $resultadoOpcoes->close();
    } else {
        echo "Erro na consulta sql";
    }
    ?>
  </select>
  <br><br>
  <button type="submit" style="background-color: green;" name="filtrar">Filtrar</button>
</form>


<br>
<form action="POST">
<button type="button" onclick="limpar()">Limpar</button>
</form>

<?php
if (isset($_POST['pesquisar']) || isset($_POST['filtrar'])) {
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
    echo "<p class='card-text'>ID: $id </p>";
    echo "<p class='card-text'>Raridade: $raridade</p>";
    echo "<p class='card-text'>Dano possivel: " . (isset($damageVisual) ? $damageVisual : '-') . "</p>";
    echo "<img src='$imagem' width='240' height='300'>";
    echo '</div>';
    echo '</div>';
  }
}
?>
<br><br>
<a href="./index.php" style="background-color: #dc143c;" type="button">Voltar</a>
</body>
</html>
