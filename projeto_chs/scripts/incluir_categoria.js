document.addEventListener('DOMContentLoaded', function() {
  var buttons = document.querySelectorAll('.btnExcluir');
  buttons.forEach(function(button) {
      button.addEventListener('click', function() {
          var idEquip = this.getAttribute('data-id');
          excluir(idEquip);
      });
  });
});

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
          console.log('certo');
      } else {
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
  
    const url = "http://127.0.0.1:80/chs/projeto_chs/cadastro_equipamento.php";
  
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