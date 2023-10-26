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
  <label for="">
    <h3>Territorios </h3>
  </label>

  <?php
  $buscarCriaturas = "SELECT c.id AS criatura_id, 
                      c.nome as criatura_nome,
                      v.recompensa_id,
                      c.territorio as criatura_territorio,
                      v.probabilidade
                      FROM ganolia_criatura c
                      LEFT JOIN ganolia_vinculo v ON c.id = v.criatura_id";

  $resultado = $conn->query($buscarCriaturas);

  if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $criatura_territorio = $row['criatura_territorio'];
            $criatura_nome = $row['criatura_nome'];
            $criatura_id = $row['criatura_id'];
            $recompensa_id = $row['recompensa_id'];
            $probabilidade = $row['probabilidade'];

            $quebrandoRecompensa = explode(";", $recompensa_id);
            $quebrandoProbabilidade = explode(";", $probabilidade);
            
            $guardarNome = array();
            foreach ($quebrandoRecompensa as $key => $recompensa) {
                $buscarNomeRecompensa = "SELECT gi.nome FROM ganolia_item gi WHERE gi.id = $recompensa";
                $resultadoNomeRecompensa = $conn->query($buscarNomeRecompensa);
            
                if ($resultadoNomeRecompensa) {
                    if ($resultadoNomeRecompensa->num_rows > 0) {
                        while ($rowNomeRecompensa = $resultadoNomeRecompensa->fetch_assoc()) {
                            $nomeRecompensa = $rowNomeRecompensa['nome'];
                            $porcentagem = $quebrandoProbabilidade[$key];
            
                            $guardarNome[] = "<b>" . $nomeRecompensa . "</b>[" . $porcentagem . "%] ";
                        }
                    } else {
                        echo "Não encontrou nome do item";
                    }
                }
            }
            $nomesRecompensa = implode(", ", $guardarNome);
            echo "<br><b>$criatura_territorio</b> | Criatura Nome: <b>" . $criatura_nome . "</b> | Nome Recompensa: $nomesRecompensa";
        }
    } else {
        echo "Nenhum registro encontrado.";
    }
} else {
    echo "Erro na consulta SQL: " . $conn->error;
}
?>


  ?>
  <br><br>
  <a href="./index_mecanismo.php" type="button" class="btn-preto">Voltar</a>


</body>

</html>