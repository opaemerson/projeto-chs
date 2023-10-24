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
            $('#resultadoCriatura').html('Nome: ' + resultado.nome + '<br>Raridade: ' + resultado.raridade + '<br>Recompensa: ' + resultado.recompensaEscolhida + '<br>Taxa% ' + resultado.numeroAleatorio);
            
            $('#imagemCriatura').attr('src', resultado.imagemEscolhida);
            $('#imagemCriatura').show();            

        } else {
            $('#resultadoCriatura').html('Erro: ' + resultado.message);
            $('#imagemCriatura').hide(); 
        }
      },
      error: function (erro) { 
        $('#resultadoCriatura').html('Erro ao buscar criatura.');
        $('#imagemCriatura').hide();  
      }
    });
}

