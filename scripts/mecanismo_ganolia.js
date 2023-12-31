var ws;

$(document).ready(function () {
  iniciarConexaoWebSocket();
  var scrollingContainer = document.getElementById('scrollingContainer');
    scrollingContainer.scrollTop = scrollingContainer.scrollHeight;
});

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

function iniciarConexaoWebSocket() {
  ws = new WebSocket('ws://localhost:8080');

  ws.onopen = (e) => {
    console.log("Conectado");
  };

  ws.onerror = function (error) {
    console.error('Erro na conexão WebSocket:', error);
  };

  ws.onmessage = function (event) {
    console.log("Mensagem recebida do servidor:", event.data);

    if (event.data === 'recarregar') {
      console.log("Recarregando a página...");
      location.reload();
    }
  };

}

function atacar() {
  const codigoItemAtaque = $('#codigoItemAtaque').val();

  const form = new FormData();
  form.append('codigoItemAtaque', codigoItemAtaque);

  const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/processar_ataque.php";

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
        $('#resultadoAtaque').html('<h3 class="red-background"> Dano Concedido: ' + danoConcedido + '</h3>');
        
        alert('Dano Realizado: ' + danoConcedido);

        if (ws && ws.readyState === WebSocket.OPEN) {
          console.log('Enviando mensagem:', 'recarregar');
          ws.send('recarregar');
        } else {
          console.error('A conexão WebSocket não está aberta.');
        }
        
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
  let idCriatura = $('#idCriatura').val();

  const form = new FormData();
  form.append('idCriatura', idCriatura);

  const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/processar_criatura.php";

  $.ajax({
    url: url, 
    method: 'POST',
    data: form, 
    processData: false, 
    contentType: false,
    dataType: 'json',
    success: function (resultado) { 
      if (resultado.success) {
          $('#resultadoCriatura').html('Nome do Alvo: ' + resultado.nome + '<br>Raridade do Alvo: ' + resultado.raridade + '<br>Recompensas possiveis:');
          
          exibirNomeDrop('#nomeDrop1', 'Nome: ' + resultado.nome1);
          exibirNomeDrop('#nomeDrop2', 'Nome: ' + resultado.nome2);
          exibirNomeDrop('#nomeDrop3', 'Nome: ' + resultado.nome3);
          exibirNomeDrop('#nomeDrop4', 'Nome: ' + resultado.nome4);

          exibirRaridadeDrop('#nomeRaridade1', 'Raridade: ' + resultado.item_raridade1);
          exibirRaridadeDrop('#nomeRaridade2', 'Raridade: ' + resultado.item_raridade2);
          exibirRaridadeDrop('#nomeRaridade3', 'Raridade: ' + resultado.item_raridade3);
          exibirRaridadeDrop('#nomeRaridade4', 'Raridade: ' + resultado.item_raridade4);

          exibirOuOcultarImagem('#imagemCriatura1', resultado.imagem1);
          exibirOuOcultarImagem('#imagemCriatura2', resultado.imagem2);
          exibirOuOcultarImagem('#imagemCriatura3', resultado.imagem3);
          exibirOuOcultarImagem('#imagemCriatura4', resultado.imagem4);

          idCriatura = '';

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

function exibirRaridadeDrop(elemento, nomeRaridade) {
  const $elemento = $(elemento);
  $elemento.empty();

  if (nomeRaridade === '' || typeof nomeRaridade === 'undefined') {
    $elemento.append('<br>'); 
  } else {
    $elemento.hide();
    $elemento.text(nomeRaridade);
    $elemento.show();
  }
}

function exibirNomeDrop(elemento, nomeDrop) {
  const $elemento = $(elemento);
  $elemento.empty();

  if (nomeDrop === '' || typeof nomeDrop === 'undefined') {
    $elemento.append('<br>'); 
  } else {
    $elemento.hide();
    $elemento.text(nomeDrop);
    $elemento.show();
  }
}

function limpar(){
  location.reload();
}

