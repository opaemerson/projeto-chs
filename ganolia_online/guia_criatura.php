<?php
require_once('../config.php');

$procurarAtaque = "SELECT * FROM ganolia_criatura gc";
$condicoes = "";

if (isset($_POST['pesquisar'])) {
    $palavra = $_POST['palavra'];
    $condicoes .= "AND (gc.nome LIKE '%$palavra%' OR gc.id LIKE '%$palavra%')";
}

if (isset($_POST['filtrar'])) {
  $territorioSelecionada = isset($_POST['territorio']) ? $_POST['territorio'] : '';
  $raridadeSelecionada = isset($_POST['raridade']) ? $_POST['raridade'] : '';
  if (!empty($territorioSelecionada)) {
      $condicoes .= "AND gc.territorio = '$territorioSelecionada'";
  }
  if (!empty($raridadeSelecionada)) {
    $condicoes .= "AND gc.raridade = '$raridadeSelecionada'";
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
  <title>Estatisticas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Oswald:wght@300&family=Playfair+Display:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
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

<div class="container mt-4">
<h3>Procure por Criatura</h3>

<form method="POST">
  <input type="text" style="width: 220px;" name="palavra" id="palavra" placeholder="Digite o ID ou NOME da Criatura">
  <button type="submit" name="pesquisar">Pesquisar</button>
</form>

<br>
<form method="POST">
  <select name="territorio" id="territorio">
    <option value="">Selecione um territorio</option>
    <?php
    $selectOpcoes = "SELECT DISTINCT gc.territorio FROM ganolia_criatura gc";
    $resultadoOpcoes = $conn->query($selectOpcoes);
    if ($resultadoOpcoes) {
        while ($rowOp = $resultadoOpcoes->fetch_assoc()) {
            $territorio = $rowOp['territorio'];
            echo "<option value='$territorio'>$territorio</option>";
        }
        $resultadoOpcoes->close();
    } else {
        echo "Erro na consulta sql";
    }
    ?>
  </select>
  <br><br>
  <select name="raridade" id="raridade">
    <option value="">Selecione um nivel</option>
    <?php
    $selectOpcoes = "SELECT DISTINCT gc.raridade FROM ganolia_criatura gc";
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
  <button type="submit" class="btn btn-dark"name="filtrar">Filtrar</button>
</form>

<br>
<form action="POST">
<button type="button" onclick="limpar()">Limpar</button>
</form>

<br>
<a href="./index_mecanismo.php" type="button" class="btn btn-danger">Voltar</a>

<?php
if (isset($_POST['pesquisar']) || isset($_POST['filtrar'])) {
while ($row = $resultadoProcurar->fetch_assoc()) {
    $id = $row['id'];
    $nome = $row['nome'];
    $territorio = $row['territorio'];
    $raridade = $row['raridade'];
    $recompensa_id = $row['recompensa_id'];
    $probabilidade = $row['probabilidade'];
    $imagem = $row['imagem'];

    if(!empty($recompensa_id)){
        $quebrandoRecompensa = explode(";", $recompensa_id);
        $quebrandoProbabilidade = explode(";", $probabilidade);
        
        $guardarNome = array();
        foreach ($quebrandoRecompensa as $key => $recompensa) {
            $buscarNomeRecompensa = "SELECT gi.nome, gi.tipo FROM ganolia_item gi WHERE gi.id = $recompensa";
            $resultadoNomeRecompensa = $conn->query($buscarNomeRecompensa);
    
            if ($resultadoNomeRecompensa == TRUE) {
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
    } else{
        $nomesRecompensa = 'Vazio';
    }

    echo '<div class="card mt-3">';
    echo '<div class="card-body">';
    echo "<h5 class='card-title'><b>$nome</b></h5>";
    echo "<p class='card-text'><b>Territorio:</b> $territorio</p>";
    echo "<p class='card-text'><b>Nivel:</b> $raridade</p>";
    echo "<img src='$imagem' width='300' height='300'>";
    echo "<p class='card-text'>Possiveis Recompensa: $nomesRecompensa</p>";
    echo '</div>';
    echo '</div>';
    }
}
?>
</div>

</body>

</html>