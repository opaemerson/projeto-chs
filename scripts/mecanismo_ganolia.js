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
            $('#resultadoConsulta').html('Nome: ' + resultado.nome + '<br>Dano: ' + resultado.damage);
            
        } else {
            $('#resultadoConsulta').html('Erro: ' + resultado.message);
        }
      },
      error: function (erro) { 
        $('#resultadoConsulta').html('Erro ao buscar o item de ataque.');
      }
    });
}
