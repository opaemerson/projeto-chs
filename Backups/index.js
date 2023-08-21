const tbody = document.querySelector(".listar_usuarios");

const listarUsuarios = async (pagina) => {
  const dados = await fetch("./list.php?pagina=" + pagina, {
    method: "GET",
  });
  const resposta = await dados.text();
  tbody.innerHTML = resposta;
};

listarUsuarios(1);


function formatarData(data) {
  const partes = data.split('-');
  const dia = partes[2];
  const mes = partes[1];
  const ano = partes[0];
  return dia + '/' + mes + '/' + ano;
}

function createUser() {
  const tag = $('#tag').val();
  const opcao = $('select[name="modelo"]').val();
  const problema = $('select[name="problema"]').val();
  const data_envio = $('#data_envio').val();
  const data_envio_formatada = formatarData(data_envio);
  const situacao = $('select[name="situacao"]').val();
  const previsao = $('#previsao').val();
  const retorno = $('#retorno').val();
  const garantia = $('#garantia').val();

  const form = new FormData();
  form.append('tag', tag);
  form.append('modelo', opcao);
  form.append('problema', problema);
  form.append('data_envio', data_envio_formatada);
  form.append('situacao', situacao);
  form.append('previsao', previsao);
  form.append('retorno', retorno);
  form.append('garantia', garantia);
  

  const url = "http://127.0.0.1:80/chs/cadastro.php";

  $.ajax({
    url: url, // URL da requisição
    method: 'POST', // Método HTTP usado na requisição
    data: form, // Dados enviados na requisição (objeto FormData)
    processData: false, // Indica que os dados não devem ser processados automaticamente, é recomendado manter esses atributos como false quando se trabalha com FormData.
    contentType: false, // Indica que o tipo de conteúdo não deve ser definido automaticamente, é recomendado manter esses atributos como false quando se trabalha com FormData.
    success: function (resultado) { // Função de callback em caso de sucesso na requisição
      console.log(resultado); // Exibe o resultado no console
      location.reload();
    },
    error: function (erro) { // Função de callback em caso de erro na requisição
      console.log(erro); // Exibe o erro no console
    }
  });

}

function remove(id) {
  if (confirm('Deseja realmente excluir este item?')){
    const url = 'http://127.0.0.1:80/chs/remove.php';
  
    $.ajax({
      url: url,
      method: 'POST',
      data: { id: id },
      success: function (resultado) {
        console.log(resultado);
        location.reload();
      },
      error: function (erro) {
        console.log(erro);
      }
    });
  }
}

function lerUsuario(id) {
  var form = new FormData(); // Cria um novo objeto FormData para enviar os dados
  form.append('id', id); // Adiciona o parâmetro 'id' ao FormData com o valor de 'id'

  const url = "http://127.0.0.1:80/chs/ler.php"; // Define a URL do arquivo PHP para onde enviar a requisição

  $.ajax({
    url: url, // Define a URL para a requisição AJAX
    method: "POST", // Define o método HTTP como POST
    data: form, // Define os dados a serem enviados como o objeto FormData
    processData: false, // Desativa o processamento automático dos dados
    contentType: false, // Define o tipo de conteúdo como falso para permitir o envio de dados binários
    success: function (data) { // Função de callback executada em caso de sucesso na requisição
      window.localStorage.setItem('user', JSON.stringify(data)); // Armazena os dados no localStorage convertendo-os para uma string JSON
      console.log(data);
      abrirModalEdicao(); // Chama a função para abrir o modal de edição
    }
  });
}

function abrirModalEdicao() {
  var userData = JSON.parse(window.localStorage.getItem('user')); // Obtém os dados do usuário do localStorage e faz o parsing para objeto JavaScript
  userData = JSON.parse(userData); // Faz o parsing adicional (se necessário) para o objeto userData
  var editIdInput = document.getElementById('editId'); //Obtém o elemento de input com o ID "editID"
  var editTagInput = document.getElementById('editTag'); // Obtém o elemento de input com o ID "editTag"
  var editModeloSelect = $('select[name="editModelo"]'); // Obtém o elemento de select com o atributo name igual a "editModelo" usando jQuery
  var editProblemaSelect = $('select[name="editProblema"]');
  var editDataEnvio = document.getElementById('editDataEnvio');
  var editSituacao = $('select[name="editSituacao"]');

  editIdInput.value = userData[0]['ID'];
  editTagInput.value = userData[0]['TAG']; // Define o valor do input com ID "editTag" com o valor da propriedade "TAG" do objeto userData
  var selecionarModelo = userData[0]['MODELO']; // Obtém o valor da propriedade "MODELO" do objeto userData e armazena em uma variável
  var selecionarProblema = userData[0]['PROBLEMA'];
  editDataEnvio.value = userData[0]['DATA_ENVIO'];
  var selecionarSituacao = userData[0]['SITUACAO'];

  editModeloSelect.val(selecionarModelo); // Define o valor selecionado no elemento de select com o atributo name igual a "editModelo"
  editProblemaSelect.val(selecionarProblema);
  editSituacao.val(selecionarSituacao);
}

function editarUsuario() {
  const id = document.getElementById('editId').value;
  const tag = document.getElementById('editTag').value;
  const opcao = $('select[name="editModelo"]').val();
  const problema = $('select[name="editProblema"]').val();
  const data_envio = document.getElementById('editDataEnvio').value;
  const situacao = $('select[name="editSituacao"]').val();

  var form = new FormData();
  form.append('id', id);
  form.append('tag', tag);
  form.append('modelo', opcao);
  form.append('problema', problema);
  form.append('data_envio', data_envio);
  form.append('situacao', situacao);

  const url = "http://127.0.0.1:80/chs/editar.php";

  $.ajax({
    url: url,
    method: "POST",
    data: form,
    processData: false,
    contentType: false,
    success: function (response) {
      console.log(response);
      location.reload();
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

function pesquisar(){

    const procurarPalavra = $('#searchInput').val();

    if (procurarPalavra == '')
      return;
  
    const form = new FormData();
    form.append('procurarPalavra', procurarPalavra);
  
    const url = "http://127.0.0.1:80/chs/pesquisar.php";
  
    $.ajax({
      url: url,
      method: 'POST',
      data: form,
      processData: false,
      contentType: false,
      success: function (resultado) {
        resultado = JSON.parse(resultado)
        console.log(resultado);

        $('.listar_usuarios').empty();

        resultado.forEach(function (obj){
          const tag = obj['tag'];
          const marcaOption = $('select[name="modelo"]').find(`option[value="${obj['modelo']}"]`);
          const marca = marcaOption.text();
          const problemaOption = $('select[name="problema"]').find(`option[value="${obj['problema']}"]`);
          const problema = problemaOption.text();
          const data_envio = obj['data_envio'];
          const situacaoOption = $('select[name="situacao"]').find(`option[value="${obj['situacao']}"]`);
          const situacao = situacaoOption.text();
          const previsao = obj['previsao'];
          const retorno = obj['retorno'];
          const garantia = obj['garantia'];

          const cabecalho = $("<tr>");
          cabecalho.append("<th>Tag</th>");
          cabecalho.append("<th>Marca</th>");
          cabecalho.append("<th>Problema</th>");
          cabecalho.append("<th>Data de Envio</th>");
          cabecalho.append("<th>Situacao</th>");
          cabecalho.append("<th>Previsao</th>");
          cabecalho.append("<th>Retorno</th>");
          cabecalho.append("<th>Garantia</th>");
          cabecalho.append("<th>Acoes</th>");
              
          const novaLista = $("<tr>");
          novaLista.append(`<td>${tag}</td>`);
          novaLista.append(`<td>${marca}</td>`);
          novaLista.append(`<td>${problema}</td>`);
          novaLista.append(`<td>${data_envio}</td>`);
          novaLista.append(`<td>${situacao} </td>`);
          novaLista.append(`<td>${previsao} </td>`);
          novaLista.append(`<td>${retorno} </td>`);
          novaLista.append(`<td>${garantia} </td>`);    
         
          const editButton = $("<button>", {
            type: "button",
            class: "btn btn-success",
            "data-bs-toggle": "modal",
            "data-bs-target": "#editModal",
            text: "Editar",
            click: function() {
              lerUsuario(obj.id);
            }
          });

          const deleteButton = $("<button>", {
            type: "button",
            class: "btn btn-danger",
            text: "Excluir",
            click: function() {
              remove(obj.id);
            }
          });

          editButton.css("marginRight", "5px");

          const actionsColumn = $("<td>");
          actionsColumn.append(editButton);
          actionsColumn.append(deleteButton);
          novaLista.append(actionsColumn);
          
          // Adicionando o cabeçalho e a nova lista na tabela
          const novaTabela = $("<table>");
          const novoCorpo = $("<tbody>");
          
          novaTabela.append(cabecalho);
          novoCorpo.append(novaLista);
          novaTabela.append(novoCorpo);
          $('.listar_usuarios').append(novaTabela);
        });
      },
      error: function (erro) {
        console.log(erro);
      }
    });
}

function filtrar() {
  const marcaOption = $('select[name="editModeloFiltro"]');
  const procurarModelo = marcaOption.val();

  if (procurarModelo === '') {
    return;
  }

  const form = new FormData();
  form.append('procurarModelo', procurarModelo);
  console.log(procurarModelo);

  const url = "http://127.0.0.1:80/chs/filtrar.php";

  $.ajax({
    url: url,
    method: 'POST',
    data: form,
    processData: false,
    contentType: false,
    success: function (resultado) {
      resultado = JSON.parse(resultado);

      // Seletor para o corpo da tabela onde queremos adicionar as linhas
      const corpoTabela = $('.listar_usuarios');

      // Limpar o conteúdo anterior da tabela antes de adicionar os novos dados
      corpoTabela.empty();

      // Verificar se existem resultados
      if (resultado.length === 0) {
        corpoTabela.append("<tr><td colspan='5'>Nenhum resultado encontrado.</td></tr>");
      } else {
        // Iterar sobre os resultados filtrados e criar as novas linhas da tabela
        resultado.forEach(function (obj) {
          const tag = obj['tag'];
          const marcaOption = $('select[name="modelo"]').find(`option[value="${obj['modelo']}"]`);
          const marca = marcaOption.text();
          const problemaOption = $('select[name="problema"]').find(`option[value="${obj['problema']}"]`);
          const problema = problemaOption.text();
          const data_envio = obj['data_envio'];
          const situacaoOption = $('select[name="situacao"]').find(`option[value="${obj['situacao']}"]`);
          const situacao = situacaoOption.text();

          const novaLista = $("<tr>");
          novaLista.append(`<td>${tag}</td>`);
          novaLista.append(`<td>${marca}</td>`);
          novaLista.append(`<td>${problema}</td>`);
          novaLista.append(`<td>${data_envio}</td>`);
          novaLista.append(`<td>${situacao}</td>`);

          corpoTabela.append(novaLista);
        });
      }
    },
    error: function (erro) {
      console.log("Erro na requisição: ", erro);
    }
  }).done(function (resultado) {
    resultado = JSON.parse(resultado)});
}

function lerArquivo(){

}
