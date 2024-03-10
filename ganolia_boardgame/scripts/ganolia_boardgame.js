var ws;

$(document).ready(function () {
  iniciarConexaoWebSocket();
  var scrollingContainer = document.getElementById('scrollingContainer');
    scrollingContainer.scrollTop = scrollingContainer.scrollHeight;
});

function mostrarJogar(){
  var divJogar = document.getElementById('jogar');
  var divAtaque = document.getElementById('ataque');
  var divDefesa = document.getElementById('defesa');
  var divRecolher = document.getElementById('recolher');
  divJogar.style.display = 'block';
  divAtaque.style.display = 'none';
  divDefesa.style.display = 'none';
  divRecolher.style.display = 'none';

  var divJogarButton = document.getElementById('jogarButton');
  var divAtaqueButton = document.getElementById('ataqueButton');
  var divDefesaButton = document.getElementById('defesaButton');
  var divRecolherButton = document.getElementById('recolherButton');
  
  divJogarButton.classList.add('ativo');
  divAtaqueButton.classList.remove('ativo');
  divDefesaButton.classList.remove('ativo');
  divRecolherButton.classList.remove('ativo');
}

function mostrarAtaque(){
  var divJogar = document.getElementById('jogar');
  var divAtaque = document.getElementById('ataque');
  var divDefesa = document.getElementById('defesa');
  var divRecolher = document.getElementById('recolher');
  divJogar.style.display = 'none';
  divAtaque.style.display = 'block';
  divDefesa.style.display = 'none';
  divRecolher.style.display = 'none';

  var divJogarButton = document.getElementById('jogarButton');
  var divAtaqueButton = document.getElementById('ataqueButton');
  var divDefesaButton = document.getElementById('defesaButton');
  var divRecolherButton = document.getElementById('recolherButton');
  
  divJogarButton.classList.remove('ativo');
  divAtaqueButton.classList.add('ativo');
  divDefesaButton.classList.remove('ativo');
  divRecolherButton.classList.remove('ativo');
}

function mostrarDefesa(){
  var divJogar = document.getElementById('jogar');
  var divAtaque = document.getElementById('ataque');
  var divDefesa = document.getElementById('defesa');
  var divRecolher = document.getElementById('recolher');
  divJogar.style.display = 'none';
  divAtaque.style.display = 'none';
  divDefesa.style.display = 'block';
  divRecolher.style.display = 'none';

  var divJogarButton = document.getElementById('jogarButton');
  var divAtaqueButton = document.getElementById('ataqueButton');
  var divDefesaButton = document.getElementById('defesaButton');
  var divRecolherButton = document.getElementById('recolherButton');
  
  divJogarButton.classList.remove('ativo');
  divAtaqueButton.classList.remove('ativo');
  divDefesaButton.classList.add('ativo');
  divRecolherButton.classList.remove('ativo');
}

function mostrarRecolher(){
  var divJogar = document.getElementById('jogar');
  var divAtaque = document.getElementById('ataque');
  var divDefesa = document.getElementById('defesa');
  var divRecolher = document.getElementById('recolher');
  divJogar.style.display = 'none';
  divAtaque.style.display = 'none';
  divDefesa.style.display = 'none';
  divRecolher.style.display = 'block';

  var divJogarButton = document.getElementById('jogarButton');
  var divAtaqueButton = document.getElementById('ataqueButton');
  var divDefesaButton = document.getElementById('defesaButton');
  var divRecolherButton = document.getElementById('recolherButton');
  
  divJogarButton.classList.remove('ativo');
  divAtaqueButton.classList.remove('ativo');
  divDefesaButton.classList.remove('ativo');
  divRecolherButton.classList.add('ativo');
}

function sair(){
  window.location.href = 'index.php'
}

function openModalMochila() {
  var modal = document.getElementById("modalMochila");
  modal.style.display = "block";
}

function closeModalMochila() {
  var modal = document.getElementById("modalMochila");
  modal.style.display = "none";
}

function buscarItemAtaque() {
    const codigoItemAtaque = $('#codigoItemAtaque').val();
  
    const form = new FormData();
    form.append('codigoItemAtaque', codigoItemAtaque);
  
    const url = "http://127.0.0.1:80/chs/ganolia_boardgame/item_ataque.php";
  
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

  const url = "http://127.0.0.1:80/chs/ganolia_boardgame/processar_ataque.php";

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

  const url = "http://127.0.0.1:80/chs/ganolia_boardgame/processar_criatura.php";

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
          
          var mt1 = document.getElementById('mt1');
          var mt2 = document.getElementById('mt2');
          var mt3 = document.getElementById('mt3');
          var mt4 = document.getElementById('mt4');
          mt1.style.border = '1px solid black';
          mt2.style.border = '1px solid black';
          mt3.style.border = '1px solid black';
          mt4.style.border = '1px solid black';
    
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

  const url = "http://127.0.0.1:80/chs/ganolia_boardgame/recolher_drop.php";

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

function verificarLoginMecanismo() {
  if (!permissaoUsuario && permissaoUsuario !== 'Amigo' || permissaoUsuario !== 'Admin') {
      alert("Voce nao possui permissao para acesso");
  } else {
      window.location.href = 'gobinc/escolhe_ganolia.php';
  }
}
