  <!-- Campo de Botões
  <div class="fundo-marrom">
    <div class="title-holder">
      <h1 class="txt-preto">C.E.E</h1>
    </div>
    <div class="nav-bar">
      <div class="">
        <button type="button" class="transparent-button">
          <a href="inicial.php">
            <img width="40" height="40" src="Images/arrow.png" >
          </a>
        </button>
        <button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#modalColetivo">Registro Coletivo</button>
        <button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#myModal">Registro Unico</button>
        <button type="button" class="btn-preto" onclick="listarUsuarios(1)">Listagem</button>
        <button type="button" class="btn-preto" data-bs-toggle="modal" data-bs-target="#filtroModal">Filtragem</button>
        <?php echo '<button type="button" class="btn-preto" onclick="validaPermissaoCategoria(\'' . $permissao . '\')">Incluir</button>'; ?>
        <a href="estatisticas.php" type="button" class="btn-preto">Estatisticas</a>
      </div>
      <div class="coluna-pesquisar">
        <input type="text" class="" id="searchInput" placeholder="Pesquise a tag">
        <button type="button" class="btn-preto" onclick="pesquisar()">Pesquisar</button>
      </div>
    </div>
    <div> -->

    <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-padding-large w3-button custom-square" title="More">MORE <i class="fa fa-caret-down"></i></button>     
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="#" class="w3-bar-item w3-button custom-square">Merchandise</a>
      <a href="#" class="w3-bar-item w3-button custom-square">Extras</a>
      <a href="#" class="w3-bar-item w3-button custom-square">Media</a>
    </div>

    2 layout

    <div class="w3-bar w3-black w3-card">
  <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
  <a href="inicial.php" class="w3-bar-item w3-button w3-padding-large custom-square">VOLTAR</a>
  <a href="inicial.php" class="w3-bar-item w3-button w3-padding-large custom-square">REGISTRO COLETIVO </a>
  <a href="#band" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square">REGISTRO UNICO</a>
  <a href="#tour" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" onclick="listarUsuarios(1)">LISTAGEM</a>
  <a href="#tour" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square" data-bs-toggle="modal" data-bs-target="#filtroModal">FILTRAGEM</a>
  <a href="#tour" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square">INCLUIR CATEGORIAS</a>
  <a href="#tour" class="w3-bar-item w3-button w3-padding-large w3-hide-small custom-square">ESTATISTICAS</a>
  <div class="coluna-pesquisar">
        <input type="text" class="" id="searchInput" placeholder="Pesquise a tag">
        <button type="button" class="btn-preto" onclick="pesquisar()">Pesquisar</button>
      </div>
</div>