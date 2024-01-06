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