document.addEventListener('DOMContentLoaded', function() {
  var button = document.getElementById('excluir');
  button.addEventListener('click', function() {
    var idEquip = this.getAttribute('data-id');

  });
});

function ctzExcluir(id){
  console.log(id);
  if (confirm('Tem certeza? Isso fara com que exclua todo o historico!')) {
    excluir(id);
  }
}

function excluir(id){
  const form = new FormData();
  form.append('id', id);

  const url = "http://127.0.0.1:80/chs/projeto_chs/servicos/repositorios/excluir_equip.php";

  $.ajax({
    url: url, 
    method: 'POST',
    data: form, 
    processData: false, 
    contentType: false,
    dataType: 'json',
    success: function (resultado) { 
      if (resultado.success) {
          window.location.href = "incluir_categoria.php";
      } else {
          console.log('erro no js');
      }
    },
    error: function (erro) {
      console.log(erro); 
    }
  });
}

function alterar(botao, id){

  var nome = botao.previousElementSibling.value;

  const form = new FormData();
  form.append('id', id);
  form.append('nome', nome);

  const url = "http://127.0.0.1:80/chs/projeto_chs/servicos/repositorios/alterar_equip.php";

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
    const nomeEquipamento = $('#nomeEquipamento').val();
  
    const form = new FormData();
    form.append('nomeEquipamento', nomeEquipamento);
  
    const url = "http://127.0.0.1:80/chs/projeto_chs/servicos/repositorios/incluir_equip.php";
  
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
  const nomeMarca = $('#nomeMarca').val();

  const form = new FormData();
  form.append('nomeMarca', nomeMarca);

  const url = "http://127.0.0.1:80/chs/projeto_chs/cadastro_marca.php";

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
  const nomeProblema = $('#nomeProblema').val();

  const form = new FormData();
  form.append('nomeProblema', nomeProblema);

  const url = "http://127.0.0.1:80/chs/projeto_chs/cadastro_problema.php";

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