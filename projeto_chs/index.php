<?php
include('../protecao.php');
require_once('../config.php');
require_once('classes/servicoPrincipal.php');

$servico = new Servico();
$config = new Config();
$usuario = $config->pegaSessaoUsuario();
$queryRegistros = $servico->buscaDados();
$permissao = $usuario['permissaoSessao'] ? $usuario['permissaoSessao'] : '';


?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CHS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/chs/cabecalho.css">
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Oswald:wght@300&family=Playfair+Display:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="amarelo-papel">
  <span id="conteudo"></span>

<div class="w3-black">
  <a style="width:14%; line-height:30px;" href="../index.php" class="w3-bar-item w3-button w3-hover-red w3-padding-large custom-square">VOLTAR </a>
  <a style="width:14%; line-height:30px;" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" data-bs-toggle="modal" data-bs-target="#myModal">REGISTRO UNICO</a>
  <a style="width:14%; line-height:30px;" class="w3-bar-item w3-button w3-padding-large custom-square" data-bs-toggle="modal" data-bs-target="#modalColetivo">IMPORTAR</a>
  <a style="width:14%; line-height:30px;" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" data-bs-toggle="modal" data-bs-target="#filtroModal">FILTRAGEM</a>
  <a style="width:14%; line-height:30px;" href="adm.php" class="w3-bar-item w3-button w3-hover-yellow w3-padding-large w3-hide-small custom-square">ADMINISTRACAO</a>
  <input style="width:18%; line-height:30px;" type="text" class="w3-ripple w3-light-grey w3-padding-medium" id="searchInput" placeholder="Pesquise a tag">
  <button style="width:10%;  line-height:30px;" type="button" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" onclick="pesquisar()">PESQUISAR</button>
</div>

<!-- Campo Exibição -->
<div class="amarelo-papel">
  <div class='table-responsive'>
    <table class='table table-striped table-bordered amarelo-papel borda-preta'>
        <thead>
            <tr>
                <th>Equipamento</th>
                <th>TAG</th>
                <th>Marca</th>
                <th>Problema</th>
                <th>Data de Envio</th>
                <th>Situacao</th>
                <th>Previsao de Retorno</th>
                <th>Data_Retorno</th>
                <th>Garantia</th>
                <th>Manutencao</th>
                <th>Usuario</th>
                <th style='text-align: center'>Ações</th>
            </tr>
        </thead>
    <tbody>
</div>
    <?php
          if($queryRegistros !== false){
            foreach($queryRegistros as $registro){
              if ($registro['situacao'] === 'Enviado') {
                  $situacaoTd = $registro['situacao'] . ' <img src="../Images/CHS/enviadow.png" class="img-enviado" alt="Enviado" width="30" height="30">';
              } elseif ($registro['situacao'] === 'Pendente') {
                  $situacaoTd = $registro['situacao'] . ' <img src="../Images/CHS/pendente.png" class="img-enviado" alt="Pendente" width="30" height="30">';
              } elseif ($registro['situacao'] === 'Concluido') {
                  $situacaoTd = $registro['situacao'] . ' <img src="../Images/CHS/concluido.png" class="img-enviado" alt="Concluido" width="30" height="30">';
              }
    
              echo "<tr>";
              echo "<td>{$registro['equipamento']}</td>";
              echo "<td>{$registro['tag']}</td>";
              echo "<td>{$registro['modelo']}</td>";
              echo "<td>{$registro['problema']}</td>";
              echo "<td>{$registro['data_envio']}</td>";
              echo "<td>{$situacaoTd}</td>";
              echo "<td>{$registro['previsao']}</td>";
              echo "<td>{$registro['retorno']}</td>";
              echo "<td>{$registro['garantia']}</td>";
              echo "<td>{$registro['manutencao']}</td>";
              echo "<td>{$registro['usuario']}</td>";
              echo "<td class='td-center'>
                      <div class='btn-center' style='text-align: center'>
                          <button type='button' class='btn btn-link' data-bs-toggle='modal' data-bs-target='#editModal' data-tagOriginal='{$registro['tag']}' 
                          data-equipamentoId='{$registro['equipamento_id']}' data-marcaOriginal='{$registro['modelo']}' data-problemaOriginal='{$registro['problema']}'>
                              <img src='../Images/CHS/editar.png' width='30' height='30'>
                          </button>
                          <button type='button' class='btn btn-link' onclick=\"alterarEvento({$registro['tag']}, 'Enviar')\">
                              <img src='../Images/CHS/enviadow.png' width='30' height='30'>
                          </button>
                          <button type='button' class='btn btn-link' onclick=\"alterarEvento({$registro['tag']}, 'Concluir')\">
                              <img src='../Images/CHS/concluido.png' width='30' height='30'>
                          </button>
                          <button type='button' class='btn btn-link' onclick=\"remove({$registro['id']}, '{$registro['idUsuario']}', '{$usuario['usuarioSessao']}', '{$usuario['permissaoSessao']}')\">
                              <img src='../Images/CHS/excluir.png' width='30' height='30'>
                          </button>
                      </div>
                  </td>";
              echo "</tr>";
          }
        }       
    ?>

<!-- Modal de Cadastro -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="servicos/cadastro.php" onsubmit="return validaCadastro()">
          <input type="hidden" id="id" name="id">
          <input type="hidden" id="data_envio" name="data_envio">
          <input type="hidden" id="usuario" name="usuario" value="<?php echo $usuario['usuarioSessao'] ?>">
          <div class="mb-3">
            <label class="form-label">Equipamento</label>
            <select class="form-select" id="id_equip" name="id_equip" aria-label="Default select example">
            <option value=''>Selecione uma opcao</option>
              <?php 
                  $arrayEquipamentos = $servico->buscaEquipamento();

                  foreach ($arrayEquipamentos as $equipamento) {
                      echo "<option value='{$equipamento['id']}'> {$equipamento['nome']} </option>";
                  }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">TAG</label>
            <input type="text" class="form-control" id="tag" name="tag" placeholder="Digite a tag aqui" style="font-style: italic;">
          </div>
          <div class="mb-3">
            <label class="form-label">Marca</label>
            <select class="form-select" id="modelo" name="modelo" aria-label="Default select example">
            <option value=''>Selecione uma opcao</option>
              <?php 
                  $arrayMarca = $servico->buscaMarca();

                  foreach ($arrayMarca as $marca) {
                      echo "<option value='{$marca['nome']}'> {$marca['nome']} </option>";
                  }
              ?>
            </select>

            <div class="mb-3">
              <label class="form-label">Problema</label>
              <select class="form-select" id="problema" name="problema">
              <option value=''>Selecione uma opcao</option>
              <?php 
                  $arrayProblema = $servico->buscaProblema();

                  foreach ($arrayProblema as $problema) {
                      echo "<option value='{$problema['nome']}'> {$problema['nome']} </option>";
                  }
              ?>
              </select>
            </div>
            <label class="form-label">Situacao</label>
            <select class="form-select" id="situacao" name="situacao">
              <option value="Pendente">Pendente</option>
              <option value="Enviado">Enviado</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" value="cadastrar">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Cadastro Coletivo -->
<div class="modal fade" id="modalColetivo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Importar Arquivo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="">
          <input type="hidden" id="data_envio" class="form-control">
          <input type="hidden" id="previsao" class="form-control">
          <input type="hidden" id="retorno" class="form-control">
          <input type="hidden" id="garantia" class="form-control">
          <div class="mb-3">
            <label for="arquivo">Selecione um arquivo:</label>
            <input type="file" id="arquivo" name="arquivo">
          </div>
          <button type="button" class="btn btn-primary" onclick="mensagemErro('incompleto')" value="cadastrar">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulário de Edição -->
        <form method="post" action="servicos/editar.php" onsubmit="return validaEdicao()">
          <div class="mb-3">
            <label class="form-label">Tag</label>
            <input type="text" class="form-control" id="editTag" name="editTag">
          </div>
          <div class="mb-3">
            <label class="form-label">Equipamento</label>
            <select class="form-select" id="editEquipamento" name="editEquipamento">
              <?php
              $arrayEquipamentos = $servico->buscaEquipamento();

              foreach ($arrayEquipamentos as $equipamento) {
                  echo "<option value='{$equipamento['id']}'> {$equipamento['nome']} </option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="editModelo" class="form-label">Marca</label>
            <select class="form-select" id="editModelo" name="editModelo">
            <option value="0">Selecione uma Marca</option>
              <?php
              $arrayMarca = $servico->buscaMarca();

              foreach ($arrayMarca as $marca) {
                  echo "<option value='{$marca['nome']}'> {$marca['nome']} </option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Problema</label>
            <select class="form-select" id="editProblema" name="editProblema">
              <option value="0">Selecione um Problema</option>
              <?php
              $arrayProblema = $servico->buscaProblema();

              foreach ($arrayProblema as $problema) {
                  echo "<option value='{$problema['nome']}'> {$problema['nome']} </option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Situação</label>
            <select class="form-select" id="editSituacao" name="editSituacao">
              <option value="0">Selecione uma Situação</option>
              <option value="Pendente">Pendente</option>
              <option value="Enviado">Enviado</option>
              <option value="Concluido">Concluido</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Filtros -->
<div class="modal fade" id="filtroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Filtrar Registros</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulário de Filtros -->
        <form id="filtroModal">
          <input type="hidden" id="filtroId" value="">
          <div class="mb-3">
            <label class="form-label">Marca</label>
            <select class="form-select" id="editModeloFiltro" name="editModeloFiltro" aria-label="Default select example">
                <?php
                    $arrayMarca = $servico->buscaMarca();

                    foreach ($arrayMarca as $marca) {
                        echo "<option value='{$marca['nome']}'> {$marca['nome']} </option>";
                    }
                ?>
              </select>
            <label class="form-label">Problema</label>
            <select class="form-select" id="problemaFiltro" name="problemaFiltro" aria-label="Default select example">
                  <?php
                    $arrayProblema = $servico->buscaProblema();

                    foreach ($arrayProblema as $problema) {
                        echo "<option value='{$problema['nome']}'> {$problema['nome']} </option>";
                    }
                  ?>
                </select>
            <label class="form-label">Situacao</label>
            <select class="form-select" id="exampleSelect" name="situacaoFiltro">
              <option value="">Selecione uma opcao</option>
              <option value="Pendente">Pendente</option>
              <option value="Enviado">Enviado</option>
              <option value="Concluido">Concluido</option>
            </select>
            <br>
            <button type="button" class="btn btn-primary" onclick="filtrar()">Filtrar</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./scripts/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>