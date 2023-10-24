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
            
            $('#imagemCriatura1').attr('src', resultado.imagem1);
            $('#imagemCriatura2').attr('src', resultado.imagem2);
            if (resultado.imagem3 === '' || typeof resultado.imagem3 === 'undefined') {
                $('#imagemCriatura3').hide();
            } else {
                $('#imagemCriatura3').attr('src', resultado.imagem3);
                $('#imagemCriatura3').show();
            }

            if (resultado.imagem4 === '' || typeof resultado.imagem4 === 'undefined') {
              $('#imagemCriatura4').hide();
            } else {
              $('#imagemCriatura4').attr('src', resultado.imagem4);
              $('#imagemCriatura4').show();
            }
            
            if (resultado.imagem5 === '' || typeof resultado.imagem5 === 'undefined') {
              $('#imagemCriatura5').hide();
          } else {
              $('#imagemCriatura5').attr('src', resultado.imagem5);
              $('#imagemCriatura5').show();
          }

            $('#imagemCriatura1').show();      
            $('#imagemCriatura2').show();           

        } else {
            $('#resultadoCriatura').html('Erro: ' + resultado.message);
            $('#imagemCriatura1').hide(); 
            $('#imagemCriatura2').hide(); 
            $('#imagemCriatura3').hide();
            $('#imagemCriatura4').hide(); 
            $('#imagemCriatura5').hide();  
        }
      },
      error: function (erro) { 
        $('#resultadoCriatura').html('Erro ao buscar criatura.');
        $('#imagemCriatura1').hide();
        $('#imagemCriatura2').hide();  
        $('#imagemCriatura3').hide();    
        $('#imagemCriatura4').hide();    
        $('#imagemCriatura5').hide();    
      }
    });
}

