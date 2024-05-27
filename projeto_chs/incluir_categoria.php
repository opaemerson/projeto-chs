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
<button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#modalEquipamento">Equipamento</button>
<br>
<button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#modalMarca">Marca</button>
<br>
<button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#modalProblema">Problema</button>
<br>
<a href="adm.php">Voltar</a>
</div>


<!-- Modal Equipamento -->
<div class="modal fade" id="modalEquipamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Equipamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="">
          <div class="mb-3">
          <button type="button" value="cadastrar" data-bs-toggle='modal' data-bs-target='#modalAddEquipamento'>Cadastrar</button>
            <br>
            <?php
                $sql = "SELECT id, nome, tipo FROM chs_equipamento";
                $resultado = $conn->query($sql);
                  while ($row = $resultado->fetch_assoc()) {
                    $idEquip = $row["id"];
                    $nomeEquip = $row["nome"];
                    $tipo = $row["tipo"];
                    echo "<br>";
                    echo "<input type='text' id='' value='$nomeEquip' readonly>";
                    echo "&nbsp;";
                    echo "<button type='button' data-bs-toggle='modal' data-bs-target='#modalAlter' onclick='alterarElemento($idEquip, \"$nomeEquip\", \"$tipo\")'>Alterar</button>";
                    echo "&nbsp;";
                    echo "<button type='button' onclick='ctzExcluir($idEquip, \"$tipo\")'>Excluir</button>";
                  }
              ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Marca -->
<div class="modal fade" id="modalMarca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Marca</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="">
          <div class="mb-3">
          <button type="button" value="cadastrar" data-bs-toggle='modal' data-bs-target='#modalAddMarca'>Cadastrar</button>
            <br>
            <?php
                $sql = "SELECT id, nome, tipo FROM chs_marca";
                $resultado = $conn->query($sql);
                  while ($row = $resultado->fetch_assoc()) {
                    $idMarca = $row["id"];
                    $nomeMarca = $row["nome"];
                    $tipo = $row["tipo"];
                    echo "<br>";
                    echo "<input type='text' id='' value='$nomeMarca' readonly>";
                    echo "&nbsp;";
                    echo "<button type='button' data-bs-toggle='modal' data-bs-target='#modalAlter' onclick='alterarElemento($idMarca, \"$nomeMarca\", \"$tipo\")'>Alterar</button>";
                    echo "&nbsp;";
                    echo "<button type='button' onclick='ctzExcluir($idMarca, \"$tipo\")'>Excluir</button>";
                  }
              ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Problema -->
<div class="modal fade" id="modalProblema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Problema</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form id="formProblema">
          <div class="mb-3">
            <button type="button" value="cadastrar" data-bs-toggle='modal' data-bs-target='#modalAddProblema'>Cadastrar</button>
            <br>
            <?php
                $sql = "SELECT id, nome, tipo FROM chs_problema";
                $resultado = $conn->query($sql);
                  while ($row = $resultado->fetch_assoc()) {
                    $idProblema = $row["id"];
                    $nomeProblema = $row["nome"];
                    $tipo = $row["tipo"];
                    echo "<br>";
                    echo "<input type='text' id='' value='$nomeProblema' readonly>";
                    echo "&nbsp;";
                    echo "<button type='button' data-bs-toggle='modal' data-bs-target='#modalAlter' onclick='alterarElemento($idProblema, \"$nomeProblema\", \"$tipo\")'>Alterar</button>";
                    echo "&nbsp;";
                    echo "<button type='button' onclick='ctzExcluir($idProblema, \"$tipo\")'>Excluir</button>";
                  }
              ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Cadastro - Equipamento -->
<div class="modal fade" id="modalAddEquipamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Equipamento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="">
          <div class="mb-3">
              <label class="form-label">Nome:</label>
              <input name="nomeEquipamento" id="nomeEquipamento"><br>
              <label class="form-label">Tempo de retorno estimado:</label>
              <input type="" name="" id="" readonly>
              <button type="button" value="" onclick="criarEquipamento()">Cadastrar</button>
              <button type="button" value="" data-bs-toggle='modal' data-bs-target='#modalEquipamento'>Voltar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Cadastro - Marca -->
<div class="modal fade" id="modalAddMarca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Marca</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="">
          <div class="mb-3">
              <label class="form-label">Nome:</label>
              <input name="nomeMarca" id="nomeMarca"><br>
              <button type="button" value="" onclick="criarMarca()">Cadastrar</button>
              <button type="button" value="" data-bs-toggle='modal' data-bs-target='#modalMarca'>Voltar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Cadastro - Problema -->
<div class="modal fade" id="modalAddProblema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Problema</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formProblema">
          <div class="mb-3">
              <label class="form-label">Nome:</label>
              <input type="text" name="nomeProblema" id="nomeProblema"><br>
              <button type="button" value="" onclick="criarProblema()">Cadastrar</button>
              <button type="button" value="" data-bs-toggle='modal' data-bs-target='#modalProblema'>Voltar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Altera��o -->
<div class="modal fade" id="modalAlter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alterar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form id="formProblema">
          <input type="hidden" name="id" id="id">
          <input type="hidden" name="tipo" id="tipo">
          <div class="mb-3">
            <label class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome"><br>
            <button type='button' onclick="alterar(this)">Alterar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<br>
<br>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="./scripts/incluir_categoria.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>