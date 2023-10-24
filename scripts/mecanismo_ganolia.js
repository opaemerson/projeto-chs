function buscarItemAtaque() {
    const codigoItemAtaque = $('#codigoItemAtaque').val();
  
    const form = new FormData();
    form.append('codigoItemAtaque', codigoItemAtaque);
  
    const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/item_ataque.php";
  
    $.ajax({
      url: url, 
      method: 'POST',
      data: form, 
      processData: false, 
      contentType: false,
      dataType: 'json',
      success: function (resultado) { 
        if (resultado.success) {
            $('#resultadoConsulta').html('Nome: ' + resultado.nome + '<br>Tipo: ' + resultado.tipo + 
            '<br>Raridade: ' + resultado.raridade + '<br>Dano possiveis: ' + resultado.danoCombinado);
            
            $('#imagemItemAtaque').attr('src', resultado.imagem);
            $('#imagemItemAtaque').show();            

        } else {
            $('#resultadoConsulta').html('Erro: ' + resultado.message);
            $('#imagemItemAtaque').hide(); 
        }
      },
      error: function (erro) { 
        $('#resultadoConsulta').html('Erro ao buscar o item de ataque.');
        $('#imagemItemAtaque').hide();  
      }
    });
}

function buscaCriatura() {
  const idCriatura = $('#idCriatura').val();

  const form = new FormData();
  form.append('idCriatura', idCriatura);

  const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/criatura.php";

  $.ajax({
    url: url, 
    method: 'POST',
    data: form, 
    processData: false, 
    contentType: false,
    dataType: 'json',
    success: function (resultado) { 
      if (resultado.success) {
          $('#resultadoCriatura').html('Nome: ' + resultado.nome + '<br>Raridade: ' + resultado.raridade);
          
          exibirOuOcultarImagem('#imagemCriatura1', resultado.imagem1);
          exibirOuOcultarImagem('#imagemCriatura2', resultado.imagem2);
          exibirOuOcultarImagem('#imagemCriatura3', resultado.imagem3);
          exibirOuOcultarImagem('#imagemCriatura4', resultado.imagem4);
          exibirOuOcultarImagem('#imagemCriatura5', resultado.imagem5);

      } else {
          $('#resultadoCriatura').html('Erro: ' + resultado.message);
          $('#imagemCriatura1, #imagemCriatura2, #imagemCriatura3, #imagemCriatura4, #imagemCriatura5').hide();
      }
    },
    error: function (erro) {
      console.log(erro); 
      $('#resultadoCriatura').html('JS - Erro ao buscar criatura.');
      $('#imagemCriatura1, #imagemCriatura2, #imagemCriatura3, #imagemCriatura4, #imagemCriatura5').hide();
    }
  });
}

function buscaDrop() {
  const idCriatura = $('#idCriatura').val();

  const form = new FormData();
  form.append('idCriatura', idCriatura);

  const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/recolher_drop.php";

  $.ajax({
    url: url, 
    method: 'POST',
    data: form, 
    processData: false, 
    contentType: false,
    dataType: 'json',
    success: function (resultado) { 
      if (resultado.success) {
          $('#resultadoDrop').html('Nome: ' + resultado.nomeEscolhido + '<br>Raridade: ' + resultado.raridadeEscolhido + '<br>' + resultado.numeroAleatorio + '%');
          
          exibirOuOcultarImagem('#imagemDrop', resultado.imagemEscolhida);

      } else {
          $('#resultadoDrop').html('Erro: ' + resultado.message);
          $('#imagemDrop').hide();
      }
    },
    error: function (erro) {
      console.log(erro); 
      $('#resultadoDrop').html('JS - Erro ao buscar criatura.');
      $('#imagemDrop').hide();
    }
  });
}

function exibirOuOcultarImagem(elemento, imagem) {
  if (imagem === '' || typeof imagem === 'undefined') {
      $(elemento).hide();
  } else {
      $(elemento).attr('src', imagem);
      $(elemento).show();
  }
}

function limpar(){
  $('#imagemDrop').hide();
  $('#imagemCriatura1, #imagemCriatura2, #imagemCriatura3, #imagemCriatura4, #imagemCriatura5').hide();
  $('#resultadoDrop').hide();
  $('#resultadoCriatura').hide();
}