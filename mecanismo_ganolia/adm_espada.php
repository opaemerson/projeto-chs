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
                  $nomeCriatura = $row['nome'];
                  $recompensa_id = $row['recompensa_id'];
                  $partes = explode(";", $recompensa_id);

                  foreach ($partes as $parte) {
                      if ($parte === $codigo) {
                        $arrayResultado[] = [
                          'array_territorio' => $nomeTerritorio,
                          'array_criatura' => $nomeCriatura,
                        ];
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
<h3>Espadas </h3>
<?php
  $buscarEquipamento = "SELECT * from ganolia_item gi
  WHERE gi.tipo = 'Espada'
  AND gi.situacao = 'A'
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
    $valor = $row['valor'];
    $situacao_mercado = $row['situacao_mercado'];
    $raridade = $row['raridade'];
    $damage = $row['damage'];
    $habilidade = $row['habilidade'];
    $taxa_habilidade = $row['taxa_habilidade'];
    $descricao = $row['descricao'];         
    $imagem = $row['imagem'];
    $territorio = buscaTerritorio ($codigo);

      echo '<div class="col-md-3">';
      echo '<div class="card mt-3">';
      echo '<div class="card-body">';
      echo '<h5 class="card-title"><img src="' . $imagem . '"  height="200" width="180">' . '<br>' . $nome . '</h5>';
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
      if($situacao_mercado == 'A'){
        echo "<h6>Situacao Mercado: $situacao_mercado</h6>";
        echo "<h6>Valor: $$valor</h6>";
      } 
      echo "<h6>Forjar: $descricao</h6>";
      foreach ($territorio as $item) {
        echo "<h6>Territorio: " . $item['array_territorio'] . "</h6>";
        echo "<h6>Criatura: " . $item['array_criatura'] . "</h6>";
      }
      echo "<td class='td-center text-start'>"
      . "<button type='button' class='btn btn-link btn-editar' 
      data-bs-toggle='modal' data-bs-target='#modalAdmEspadas' 
      data-id='$codigo'
      data-nome='$nome'
      data-dados='$dados'
      data-raridade='$raridade'
      data-damage = '$damage'
      data-habilidade = '$habilidade'
      data-taxahabilidade = '$taxa_habilidade'>"
      . "<img src='../Images/CHS/editar.png' width='25' height='25'>"
      . "</button>"
      . "</td>";      
      echo '</div>';
      echo '</div>';
      echo '</div>';
      }
    }
} else {
echo "Nenhum registro encontrado.";
}
?>

<div class="modal fade" id="modalAdmEspadas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Espada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="processar_espadas.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" id="idEspada" name="idEspada">    
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeEspada" name="nomeEspada">

                        <label class="form-label">Raridade</label>
                        <select class="form-select" id="nomeRaridade" name="nomeRaridade">
                            <option value="Comum">Comum</option>
                            <option value="Incomum">Incomum</option>
                            <option value="Magico">Mágico</option>
                            <option value="Raro">Raro</option>
                            <option value="Lendario">Lendário</option>
                        </select> 

                        <label class="form-label">Dados</label>
                        <input type="text" class="form-control" id="nomeDados" name="nomeDados">
                        
                        <label class="form-label">Damage</label>
                        <input type="text" class="form-control" id="nomeDamage" name="nomeDamage">
                        
                        <label class="form-label">Habilidade</label>
                        <input type="text" class="form-control" id="nomeHabilidade" name="nomeHabilidade">
                        
                        <label class="form-label">Taxa Habilidade</label>
                        <input type="text" class="form-control" id="nomeTaxahabilidade" name="nomeTaxahabilidade">
                        
                      </div>                       
                    <button type="submit" class="btn btn-primary" value="cadastrar">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
      document.addEventListener('DOMContentLoaded', function () {
      var btnEditar = document.querySelectorAll('.btn-editar');

        btnEditar.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var idEspada = this.getAttribute('data-id');
                document.getElementById('idEspada').value = idEspada;

                var nomeEspada = this.getAttribute('data-nome');
                document.getElementById('nomeEspada').value = nomeEspada;

                var nomeRaridade = this.getAttribute('data-raridade');
                document.getElementById('nomeRaridade').value = nomeRaridade;

                var nomeDados = this.getAttribute('data-dados');
                document.getElementById('nomeDados').value = nomeDados;
              
                var nomeDamage = this.getAttribute('data-damage');
                document.getElementById('nomeDamage').value = nomeDamage;
              
                var nomeHabilidade = this.getAttribute('data-habilidade');
                document.getElementById('nomeHabilidade').value = nomeHabilidade;
              
                var nomeTaxahabilidade = this.getAttribute('data-taxahabilidade');
                document.getElementById('nomeTaxahabilidade').value = nomeTaxahabilidade;
              
              });
        });
    });
</script>

