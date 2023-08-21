<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CHS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body class="amarelo-papel">
  <span id="conteudo"></span>

<!-- Campo de Botões-->
<div class="fundo-marrom">
<div class="title-holder">
<h1 class="txt-preto">Puddng</h1>
<img src="Images/pudimx.png" alt="10" width="75" style="margin-top: 5px;">
</div>
  <div class="nav-bar">
    <div class="">
      <button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#modalColetivo">Registro Coletivo</button>
      <button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#myModal">Registro Unico</button>
      <button type="button" class="btn-preto" onclick="listarUsuarios(1)">Listagem</button>
      <button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#filtroModal">Filtragem</button>
    </div>
    <div class="coluna-pesquisar">
        <input type="text" class="" id="searchInput" placeholder="Pesquise a tag">
        <button type="button" class="btn-preto" onclick="pesquisar()">Pesquisar</button>
    </div>
  </div>

<div>
  
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
          <input type="hidden" id="data_envio" class="form-control">
          <input type="hidden" id="previsao" class="form-control">
          <input type="hidden" id="retorno" class="form-control">
          <input type="hidden" id="garantia" class="form-control">
          <div class="mb-3">
            <label class="form-label">TAG</label>
            <input type="text" class="form-control" id="tag">
          </div>
          <div class="mb-3">
            <label  class="form-label">Marca</label>
            <select class="form-select" id="exampleSelect" name="modelo" aria-label="Default select example">
              <option value="One">One</option>
              <option value="Two">Two</option>
              <option value="Three">Three</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Problema</label>
            <select class="form-select" id="problema" name="problema" aria-label="Default select example">
              <option value="One">One</option>
              <option value="Two">Two</option>
              <option value="Three">Three</option>
            </select>
          </div>
          <label class="form-label">Situacao</label>
          <select class="form-select" id="situacao" name="situacao" aria-label="Default select example">
            <option value="Pendente">Pendente</option>
            <option value="Enviado">Enviado</option>
          </select>
        </div>
          <button type="submit" class="btn btn-primary" value="cadastrar" onclick="createUser()">Submit</button>
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
        <input type="hidden" id="editGarantia" class="form-control">
          <div class="mb-3">
            <label for="editTag" class="form-label">Tag</label>
            <input type="text" class="form-control" id="editTag">
          </div>
          <div class="mb-3">
            <label for="editModelo" class="form-label">Marca</label>
            <input type="text" class="form-control" id="editModelo" >
          </div>
          <div class="mb-3">
            <label class="form-label">Problema</label>
            <input type="text" class="form-control" id="editProblema" >
          </div>
          <div class="mb-3">
            <label for="editDataEnvio" class="form-label">Data-Envio</label>
            <input type="text" id="editDataEnvio" class="form-control">
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
            <select class="form-select" id="exampleSelect" name="editModeloFiltro" aria-label="Default select example">
              <option value="One">One</option>
              <option value="Two">Two</option>
              <option value="Three">Three</option>
            </select>
          <!-- Botão de Salvar -->
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