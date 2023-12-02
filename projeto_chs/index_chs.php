<?php
include('../protecao.php');
require_once('../config.php');
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CHS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="../css/cabecalho.css">
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Oswald:wght@300&family=Playfair+Display:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  body {font-family: "Lato", sans-serif}
  .mySlides {display: none}
  
  </style>
</head>

<body class="amarelo-papel">
  <span id="conteudo"></span>
  <?php
  $permissao = isset($_SESSION['permissao']) ? $_SESSION['permissao'] : '';
  ?>


<div class="w3-bar w3-black w3-card">
  <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
  <a href="../index.php" class="w3-bar-item w3-button w3-hover-red w3-padding-large custom-square">VOLTAR </a>
  <a class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" data-bs-toggle="modal" data-bs-target="#myModal">REGISTRO UNICO</a>
  <a class="w3-bar-item w3-button w3-padding-large custom-square" data-bs-toggle="modal" data-bs-target="#modalColetivo">IMPORTAR</a>
  <a class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" data-bs-toggle="modal" data-bs-target="#filtroModal">FILTRAGEM</a>
  <?php echo '<a  class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" onclick="validaPermissaoCategoria(\'' . $permissao . '\')">INCLUIR</a>'; ?>
  <a href="estatisticas.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square">ESTATISTICAS</a>
  <div class="coluna-pesquisar">
        <input type="text" class="" id="searchInput" placeholder="Pesquise a tag">
        <button type="button" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" onclick="pesquisar()">PESQUISAR</button>
      </div>
</div>


      <!-- Campo Exibição -->
      <div class="amarelo-papel">
        <span class="listar_usuarios"></span>
      </div>

      <!-- Modal de Cadastro -->
      <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Formulario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="myForm">
                <input type="hidden" id="id" class="form-control">
                <input type="hidden" id="data_envio" class="form-control">
                <input type="hidden" id="previsao" class="form-control">
                <input type="hidden" id="retorno" class="form-control">
                <input type="hidden" id="garantia" class="form-control">
                <input type="hidden" id="usuario" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>">
                <div class="mb-3">
                  <label class="form-label">Equipamento</label>
                  <select class="form-select" id="id_equip" name="id_equip" aria-label="Default select example">
                    <?php
                    $sqlEquipamento = "SELECT id, nome FROM equipamento";
                    $resultadoEquip = $conn->query($sqlEquipamento);
                    if ($resultadoEquip) {
                      echo "<option value=''>Selecione uma opcao</option>";
                      while ($rowEquip = $resultadoEquip->fetch_assoc()) {
                        $idEquip = $rowEquip["id"];
                        $nomeEquip = $rowEquip["nome"];
                        echo "<option value='$idEquip'>$nomeEquip</option>";
                      }
                      $resultadoEquip->close();
                    } else {
                      echo "Erro na consulta: " . $conn->error;
                    }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">TAG</label>
                  <input type="text" class="form-control" id="tag">
                </div>
                <div class="mb-3">
                  <label class="form-label">Marca</label>
                  <select class="form-select" id="modelo" name="modelo" aria-label="Default select example">
                    <?php
                    $sqlMarca = "SELECT nome FROM marca";
                    $resultado = $conn->query($sqlMarca);
                    if ($resultado) {
                      echo "<option value=''>Selecione uma opcao</option>";
                      while ($rowMarca = $resultado->fetch_assoc()) {
                        $nomeMarca = $rowMarca["nome"];
                        echo "<option value='$nomeMarca'>$nomeMarca</option>";
                      }
                      $resultado->close();
                    } else {
                      echo "Erro na consulta: " . $conn->error;
                    }
                    ?>
                  </select>

                  <div class="mb-3">
                    <label class="form-label">Problema</label>
                    <select class="form-select" id="problema" name="problema" aria-label="Default select example">
                      <?php
                      $sql = "SELECT nome FROM problema";
                      $result = $conn->query($sql);
                      if ($result) {
                        echo "<option value=''>Selecione uma opcao</option>";
                        while ($row = $result->fetch_assoc()) {
                          $nomeProblema = $row["nome"];
                          echo "<option value='$nomeProblema'>$nomeProblema</option>";
                        }
                        $result->close();
                      } else {
                        echo "Erro na consulta: " . $conn->error;
                      }
                      ?>
                    </select>
                  </div>
                  <label class="form-label">Situacao</label>
                  <select class="form-select" id="situacao" name="situacao" aria-label="Default select example">
                    <option value="Pendente">Pendente</option>
                    <option value="Enviado">Enviado</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary" value="cadastrar" onclick="createUser()">Enviar</button>
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
              <form action="processar_upload.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="data_envio" class="form-control">
                <input type="hidden" id="previsao" class="form-control">
                <input type="hidden" id="retorno" class="form-control">
                <input type="hidden" id="garantia" class="form-control">
                <div class="mb-3">
                  <label for="arquivo">Selecione um arquivo:</label>
                  <input type="file" id="arquivo" name="arquivo">
                </div>
                <button type="submit" class="btn btn-primary" value="cadastrar">Enviar</button>
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
              <form id="editForm">
                <input type="hidden" id="editId" value="">
                <input type="hidden" id="editGarantia" >
                <input type="hidden" id="editDataEnvio">
                <div class="mb-3">
                  <label for="editTag" class="form-label">Tag</label>
                  <input type="text" class="form-control" id="editTag">
                </div>
                <div class="mb-3">
                  <label for="editModelo" class="form-label">Marca</label>
                  <select class="form-select" id="editModelo" name="editModelo" aria-label="Default select example">
                    <?php
                    $sqlMarca = "SELECT nome FROM marca";
                    $resultado = $conn->query($sqlMarca);
                    if ($resultado) {
                      while ($rowMarca = $resultado->fetch_assoc()) {
                        $nomeMarca = $rowMarca["nome"];
                        echo "<option value='$nomeMarca'>$nomeMarca</option>";
                      }
                      $resultado->close();
                    } else {
                      echo "Erro na consulta: " . $conn->error;
                    }
                    ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Problema</label>
                  <select class="form-select" id="editProblema" name="editProblema" aria-label="Default select example">
                      <?php
                      $sql = "SELECT nome FROM problema";
                      $result = $conn->query($sql);
                      if ($result) {
                        while ($row = $result->fetch_assoc()) {
                          $nomeProblema = $row["nome"];
                          echo "<option value='$nomeProblema'>$nomeProblema</option>";
                        }
                        $result->close();
                      } else {
                        echo "Erro na consulta: " . $conn->error;
                      }
                      ?>
                    </select>
                </div>
                <label class="form-label">Situacao</label>
                <select class="form-select" id="editSituacao" name="editSituacao" aria-label="Default select example">
                  <option value="Pendente">Pendente</option>
                  <option value="Enviado">Enviado</option>
                  <option value="Concluido">Concluido</option>
                </select>
            </div>
            <!-- Botão de Salvar -->
            <button type="submit" class="btn btn-primary" value="Atualizar" onclick="editarUsuario()">Salvar</button>
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
                    $sqlMarca = "SELECT nome FROM marca";
                    $resultado = $conn->query($sqlMarca);
                    if ($resultado) {
                      echo "<option value=''>Selecione uma opcao</option>";
                      while ($rowMarca = $resultado->fetch_assoc()) {
                        $nomeMarca = $rowMarca["nome"];
                        echo "<option value='$nomeMarca'>$nomeMarca</option>";
                      }
                      $resultado->close();
                    } else {
                      echo "Erro na consulta: " . $conn->error;
                    }
                    ?>
                  </select>
                <label class="form-label">Problema</label>
                <select class="form-select" id="problemaFiltro" name="problemaFiltro" aria-label="Default select example">
                      <?php
                      $sql = "SELECT nome FROM problema";
                      $result = $conn->query($sql);
                      if ($result) {
                        echo "<option value=''>Selecione uma opcao</option>";
                        while ($row = $result->fetch_assoc()) {
                          $nomeProblema = $row["nome"];
                          echo "<option value='$nomeProblema'>$nomeProblema</option>";
                        }
                        $result->close();
                      } else {
                        echo "Erro na consulta: " . $conn->error;
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
                <!-- Botão de Salvar -->
                <button type="button" class="btn btn-primary" onclick="filtrar()">Filtrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../scripts/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>