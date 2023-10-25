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
          $('#resultadoConsulta').html('Nome: ' + resultado.nome + '<br>Tipo: ' + resultado.tipo + '<br>Raridade: ' + resultado.raridade);

          if (resultado.damageVisual === '' || typeof resultado.damageVisual === 'undefined') {
            $('#resultadoConsulta').append('<br> '); 
          } else {
            $('#resultadoConsulta').append('<br>Damage: ' + resultado.damageVisual); 
          }
            
            $('#imagemItemAtaque').attr('src', resultado.imagem);
            $('#imagemItemAtaque').show();            

        } else {
            $('#resultadoConsulta').html('Erro: ' + resultado.message);
            $('#imagemItemAtaque').hide(); 
        }
      },
      error: function (erro) { 
        console.log(erro);
        $('#resultadoConsulta').html('Erro ao buscar o item de ataque.');
        $('#imagemItemAtaque').hide();  
      }
    });
}

function atacar() {
  const codigoItemAtaque = $('#codigoItemAtaque').val();

  const form = new FormData();
  form.append('codigoItemAtaque', codigoItemAtaque);

  const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/atacar.php";

  $.ajax({
    url: url, 
    method: 'POST',
    data: form, 
    processData: false, 
    contentType: false,
    dataType: 'json',
    success: function (resultado) { 
      if (resultado.success) {
        var danoConcedido = resultado.damageAleatorio;
        $('#resultadoAtaque').html('<h3> Dano Concedido: ' + danoConcedido + '</h3>');
        
        alert('Dano Realizado: ' + danoConcedido);
        
      } else {
          $('#resultadoAtaque').html('Erro: ' + resultado.message);
      }
    },
    error: function (erro) {
      console.log(erro); 
      $('#resultadoAtaque').html('[js] - Erro ao realizar ataque.');
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
          $('#resultadoCriatura').html('Nome do Alvo: ' + resultado.nome + '<br>Raridade do Alvo: ' + resultado.raridade);
          
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
          $('#resultadoDrop').html('Id: ' + resultado.idEscolhido + '<br>Nome: ' + resultado.nomeEscolhido + '<br>Raridade: ' + resultado.raridadeEscolhido + '<br>' + resultado.numeroAleatorio + '%');
          
          exibirOuOcultarImagem('#imagemDrop', resultado.imagemEscolhida);

          alert('Nome: ' + resultado.nomeEscolhido + '\nRaridade: ' + resultado.raridadeEscolhido);

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
  $('#resultadoAtaque').hide();
  $('#imagemItemAtaque').hide();
  $('#resultadoConsulta').hide();
}