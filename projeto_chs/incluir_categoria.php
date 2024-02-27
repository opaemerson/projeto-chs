<?php
include('../protecao.php');
require_once('../config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CHS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Oswald:wght@300&family=Playfair+Display:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
<style>
      .centralizar {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
</style>
</head>
<body>

<div class="centralizar"> 
<h2>Inclusao/Alteracao</h2>
<br>
<button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#addEquipamento">Equipamento</button>
<br>
<button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#addMarca">Marca</button>
<br>
<button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#addProblema">Problema</button>
<br>
<a href="index_chs.php">Voltar</a>
</div>



<div class="modal fade" id="addEquipamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Equipamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formMarca">
          <div class="mb-3">
            <label class="form-label">Nome</label>
              <?php
                $sql = "SELECT id, nome FROM chs_equipamento";
                $resultado = $conn->query($sql);
                  while ($row = $resultado->fetch_assoc()) {
                    $idEquip = $row["id"];
                    $nomeEquip = $row["nome"];
                    echo "<br>";
                    echo "<input type='text' value='$nomeEquip'>";
                    echo "<button type='button' class='btnExcluir' data-name='$nomeEquip' data-id='$idEquip'>Excluir</button>";
                  }
                  $resultado->close();
              ?>
          </div>
          <button type="button" class="btn btn-primary" value="cadastrar" onclick="criarEquipamento()">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addMarca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Marca</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formMarca">
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" name="nomeMarca" id="nomeMarca">
          </div>
          <button type="button" class="btn btn-primary" value="cadastrar" onclick="criarMarca()">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addProblema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar Problema</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formProblema">
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" class="form-control" id="nomeProblema">
          </div>
          <button type="button" class="btn btn-primary" value="cadastrar" onclick="criarProblema()">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<br>
<br>
<a href="index_chs.php" type="button" class="btn-preto">Voltar</a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./scripts/incluir_categoria.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>