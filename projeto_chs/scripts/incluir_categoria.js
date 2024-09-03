function ctzExcluir(id, tipo){
  
  if(tipo == 'Equipamento'){
    if (confirm('Tem certeza? Isso fara com que exclua todo o historico!')) {
      excluir(id,tipo);
    }
  }else{
    if(confirm('Tem certeza?')){
      excluir(id,tipo);
    }
  }
}

function excluir(id,tipo){
  const form = new FormData();
  form.append('id', id);
  form.append('tipo', tipo);

  let url;

  if(tipo == 'Equipamento'){
    url = "http://127.0.0.1/projeto_chs/projeto_chs/servicos/excluir_equip.php";
  }

  if(tipo == 'Marca'){
    url = "http://127.0.0.1/projeto_chs/projeto_chs/servicos/excluir_marca.php";
  }

  if(tipo == 'Problema'){
    url = "http://127.0.0.1/projeto_chs/projeto_chs/servicos/excluir_problema.php";
  }


  $.ajax({
    url: url, 
    method: 'POST',
    data: form, 
    processData: false, 
    contentType: false,
    dataType: 'json',
    success: function () { 
      window.location.href = "./incluir_categoria.php";
    },
    error: function (erro) {
      window.location.href = "./incluir_categoria.php";
      console.log(erro); 
    }
  });
}

function alterarElemento(id, nome, tipo){
  document.getElementById("id").value = id;
  document.getElementById("nome").value = nome;
  document.getElementById("tipo").value = tipo;
}

function alterar(botao, id, tipo){

  var nome = botao.previousElementSibling.value;

  if (nome == "" || nome == undefined) {
    nome = document.getElementById("nome").value;
  }

  var id = document.getElementById("id").value
  var tipo = document.getElementById("tipo").value

  const form = new FormData();
  form.append('id', id);
  form.append('tipo', tipo);
  form.append('nome', nome);

  let url;

  if(tipo == 'Equipamento'){
    url = "http://127.0.0.1/projeto_chs/projeto_chs/servicos/alterar_equip.php";
  }

  if(tipo == 'Marca'){
    url = "http://127.0.0.1/projeto_chs/projeto_chs/servicos/alterar_marca.php";
  }

  if(tipo == 'Problema'){
    url = "http://127.0.0.1/projeto_chs/projeto_chs/servicos/alterar_problema.php";
  }

  $.ajax({
    url: url, 
    method: 'POST',
    data: form, 
    processData: false, 
    contentType: false,
    dataType: 'json',
    success: function (resultado) { 
      if (resultado.success) {
          alert(resultado.mensagem);
          window.location.href = "incluir_categoria.php";
      } else {
          alert(resultado.mensagem);
          console.log('erro no js');
      }
    },
    error: function (erro) {
      console.log(erro); 
    }
  });
}

function criarEquipamento() {
    var nomeEquipamento = $('#nomeEquipamento').val();
    var usuarioId = $('#usuarioId').val();
  
    const form = new FormData();
    form.append('nomeEquipamento', nomeEquipamento);
    form.append('usuarioId', usuarioId);
  
    const url = "http://127.0.0.1/projeto_chs/projeto_chs/servicos/incluir_equip.php";
  
    $.ajax({
      url: url, 
      method: 'POST',
      data: form, 
      processData: false, 
      contentType: false,
      dataType: 'json', 
      success: function (resultado) { 
        if (resultado.erro) {
            alert(resultado.mensagem)
          } else {
            alert(resultado.mensagem)
            location.reload();
          }
      },
      error: function (erro) { 
        console.log(erro); 
      }
    });
}

function criarMarca() {
  var nomeMarca = $('#nomeMarca').val();
  var usuarioId = $('#usuarioId').val();

  const form = new FormData();
  form.append('nomeMarca', nomeMarca);
  form.append('usuarioId', usuarioId);

  const url = "http://127.0.0.1/projeto_chs/projeto_chs/servicos/incluir_marca.php";

  $.ajax({
    url: url, 
    method: 'POST',
    data: form, 
    processData: false, 
    contentType: false,
    dataType: 'json', 
    success: function (resultado) { 
      if (resultado.erro) {
          alert(resultado.mensagem)
        } else {
          alert(resultado.mensagem)
          location.reload();
        }
    },
    error: function (erro) { 
      console.log(erro); 
    }
  });
}

function criarProblema() {

  var nomeProblema = $('#nomeProblema').val();
  var usuarioId = $('#usuarioId').val();

  const form = new FormData();
  form.append('nomeProblema', nomeProblema);
  form.append('usuarioId', usuarioId);

  const url = "http://127.0.0.1/projeto_chs/projeto_chs/servicos/incluir_problema.php";

  $.ajax({
    url: url, 
    method: 'POST',
    data: form, 
    processData: false, 
    contentType: false,
    dataType: 'json', 
    success: function (resultado) { 
      if (resultado.erro) {
          alert(resultado.mensagem)
        } else {
          alert(resultado.mensagem)
          location.reload();
        }
    },
    error: function (erro) { 
      console.log(erro); 
    }
  });

}