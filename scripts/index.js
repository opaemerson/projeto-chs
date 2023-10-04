const tbody = document.querySelector(".listar_usuarios");

const listarUsuarios = async (pagina) => {
  const dados = await fetch("./listar.php?pagina=" + pagina, {
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
  const usuario = $('#usuario').val();

  const form = new FormData();
  form.append('tag', tag);
  form.append('modelo', opcao);
  form.append('problema', problema);
  form.append('data_envio', data_envio_formatada);
  form.append('situacao', situacao);
  form.append('previsao', previsao);
  form.append('retorno', retorno);
  form.append('garantia', garantia);
  form.append('usuario', usuario);

  console.log(usuario);

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

function remove(id, idUsuario, usuarioSessao, permissaoSessao) {
  if (confirm('Deseja realmente excluir este item?')){
    const url = 'http://127.0.0.1:80/chs/remove.php';
  
    $.ajax({
      url: url,
      method: 'POST',
      data: { id: id ,
            idUsuario: idUsuario,
            usuarioSessao: usuarioSessao,
            permissaoSessao: permissaoSessao
            },
      dataType: 'json',
      success: function (resultado) {
        if(resultado.erro){
          alert(resultado.mensagem)
        } else{
          alert("Sucesso")
          location.reload();
        }

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
  var editModeloInput= document.getElementById('editModelo'); // Obtém o elemento de select com o atributo name igual a "editModelo" usando jQuery
  var editProblemaInput = document.getElementById('editProblema');
  var editDataEnvio = document.getElementById('editDataEnvio');
  var editSituacao = $('select[name="editSituacao"]');

  editIdInput.value = userData[0]['ID'];
  editTagInput.value = userData[0]['TAG']; // Define o valor do input com ID "editTag" com o valor da propriedade "TAG" do objeto userData
  editModeloInput.value = userData[0]['MODELO'];
  editProblemaInput.value = userData[0]['PROBLEMA'];
  editDataEnvio.value = userData[0]['DATA_ENVIO'];
  var selecionarSituacao = userData[0]['SITUACAO'];

  editSituacao.val(selecionarSituacao);
}

function editarUsuario() {
  const id = document.getElementById('editId').value;
  const tag = document.getElementById('editTag').value;
  const opcao = document.getElementById('editModelo').value;
  const problema = document.getElementById('editProblema').value;
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

function pesquisar() {
  const procurarPalavra = $('#searchInput').val();

  if (procurarPalavra === '') return;

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
      resultado = JSON.parse(resultado);
      console.log(resultado);

      // Limpar a lista de usuários antes de adicionar novos
      $('.listar_usuarios').empty();

      // Criação da tabela e do cabeçalho
      const table = $("<table>").addClass("table table-striped table-bordered amarelo-papel borda-preta");
      const thead = $("<thead>").appendTo(table);
      const tbody = $("<tbody>").appendTo(table);
      const headerRow = $("<tr>").appendTo(thead);
      $("<th>").text("TAG").appendTo(headerRow);
      $("<th>").text("Marca").appendTo(headerRow);
      $("<th>").text("Problema").appendTo(headerRow);
      $("<th>").text("Data de Envio").appendTo(headerRow);
      $("<th>").text("Situacao").appendTo(headerRow);
      $("<th>").text("Previsao de Retorno").appendTo(headerRow);
      $("<th>").text("Data_Retorno").appendTo(headerRow);
      $("<th>").text("Garantia").appendTo(headerRow);
      $("<th>").text("Manutencao").appendTo(headerRow);
      $("<th>").text("Usuario").appendTo(headerRow);
      $("<th>").text("Acoes").appendTo(headerRow);

      resultado.forEach(function (obj) {
        const tag = obj['tag'];
        const marcaOption = $('select[name="modelo"]').find(`option[value="${obj['modelo']}"]`);
        const marca = marcaOption.text();
        const problemaOption = $('select[name="problema"]').find(`option[value="${obj['problema']}"]`);
        const problema = problemaOption.text();
        const data_envio = obj['data_envio'];
        let situacao = obj['situacao'];
        const previsao = obj['previsao'];
        const retorno = obj['retorno'];
        const garantia = obj['garantia'];
        const manutencao = obj['manutencao'];
        const usuario = obj['usuario'];


        const novaLista = $("<tr>");
        novaLista.append(`<td>${tag}</td>`);
        novaLista.append(`<td>${marca}</td>`);
        novaLista.append(`<td>${problema}</td>`);
        novaLista.append(`<td>${data_envio}</td>`);
        novaLista.append(`<td>${situacao} </td>`);
        novaLista.append(`<td>${previsao} </td>`);
        novaLista.append(`<td>${retorno} </td>`);
        novaLista.append(`<td>${garantia} </td>`);
        novaLista.append(`<td>${manutencao} </td>`);
        novaLista.append(`<td>${usuario} </td>`);

        const editButton = $("<button>", {
          type: "button",
          class: "btn btn-link",
          "data-bs-toggle": "modal",
          "data-bs-target": "#editModal",
          html: `<img src='Images/editar.png' width='30' height='30' alt='Editar'>`,
          click: function () {
            lerUsuario(obj.id);
          },
        });

        const deleteButton = $("<button>", {
          type: "button",
          class: "btn btn-link",
          html: `<img src='Images/excluir.png' width='30' height='30'alt='Excluir'>`,
          click: function () {
            remove(obj.id);
          },
        });

        editButton.css("marginRight", "5px");

        const actionsCell = $("<td>");
        actionsCell.append(editButton);
        actionsCell.append(deleteButton);
        novaLista.append(actionsCell);

        tbody.append(novaLista);
      });

      // Adicionando a tabela à div com a classe "listar_usuarios"
      $('.listar_usuarios').append(table);
    },
    error: function (erro) {
      console.log(erro);
    },
  });
}

function filtrar() {
  const marcaOption = $('select[name="editModeloFiltro"]');
  const procurarModelo = marcaOption.val();
  const problemaOption = $('select[name="problemaFiltro"]');
  const procurarProblema = problemaOption.val();

  if (procurarModelo === '' || procurarProblema) {
    return;
  }

  const form = new FormData();
  form.append('procurarModelo', procurarModelo);
  form.append('procurarProblema', procurarProblema);


  const url = "http://127.0.0.1:80/chs/filtrar.php";

  $.ajax({
    url: url,
    method: 'POST',
    data: form,
    processData: false,
    contentType: false,
    success: function (resultado) {
      resultado = JSON.parse(resultado);

      $('.listar_usuarios').empty();

      // Verificar se existem resultados
      if (resultado.length === 0) {
        corpoTabela.append("<tr><td colspan='5'>Nenhum resultado encontrado.</td></tr>");
      } else {
        const table = $("<table>").addClass("table table-striped table-bordered amarelo-papel borda-preta");
        const thead = $("<thead>").appendTo(table);
        const tbody = $("<tbody>").appendTo(table);
        const headerRow = $("<tr>").appendTo(thead);
        $("<th>").text("TAG").appendTo(headerRow);
        $("<th>").text("Marca").appendTo(headerRow);
        $("<th>").text("Problema").appendTo(headerRow);
        $("<th>").text("Data de Envio").appendTo(headerRow);
        $("<th>").text("Situacao").appendTo(headerRow);
        $("<th>").text("Previsao de Retorno").appendTo(headerRow);
        $("<th>").text("Data_Retorno").appendTo(headerRow);
        $("<th>").text("Garantia").appendTo(headerRow);
        $("<th>").text("Manutencao").appendTo(headerRow);
        $("<th>").text("Usuario").appendTo(headerRow);
        $("<th>").text("Acoes").appendTo(headerRow);
  
        resultado.forEach(function (obj) {
          const tag = obj['tag'];
          const marcaOption = $('select[name="modelo"]').find(`option[value="${obj['modelo']}"]`);
          const marca = marcaOption.text();
          const problemaOption = $('select[name="problema"]').find(`option[value="${obj['problema']}"]`);
          const problema = problemaOption.text();
          const data_envio = obj['data_envio'];
          let situacao = obj['situacao'];
          const previsao = obj['previsao'];
          const retorno = obj['retorno'];
          const garantia = obj['garantia'];
          const manutencao = obj['manutencao'];
          const usuario = obj['usuario'];
  
          const novaLista = $("<tr>");
          novaLista.append(`<td>${tag}</td>`);
          novaLista.append(`<td>${marca}</td>`);
          novaLista.append(`<td>${problema}</td>`);
          novaLista.append(`<td>${data_envio}</td>`);
          novaLista.append(`<td>${situacao} </td>`);
          novaLista.append(`<td>${previsao} </td>`);
          novaLista.append(`<td>${retorno} </td>`);
          novaLista.append(`<td>${garantia} </td>`);
          novaLista.append(`<td>${manutencao} </td>`);
          novaLista.append(`<td>${usuario} </td>`);
  
          const editButton = $("<button>", {
            type: "button",
            class: "btn btn-link",
            "data-bs-toggle": "modal",
            "data-bs-target": "#editModal",
            html: `<img src='Images/editar.png' width='30' height='30' alt='Editar'>`,
            click: function () {
              lerUsuario(obj.id);
            },
          });
  
          const deleteButton = $("<button>", {
            type: "button",
            class: "btn btn-link",
            html: `<img src='Images/excluir.png' width='30' height='30'alt='Excluir'>`,
            click: function () {
              remove(obj.id);
            },
          });
  
          editButton.css("marginRight", "5px");
  
          const actionsCell = $("<td>");
          actionsCell.append(editButton);
          actionsCell.append(deleteButton);
          novaLista.append(actionsCell);
  
          tbody.append(novaLista);
        });
  
        // Adicionando a tabela à div com a classe "listar_usuarios"
        $('.listar_usuarios').append(table);
      }
    },
    error: function (erro) {
      console.log("Erro na requisição: ", erro);
    }
  }).done(function (resultado) {
    resultado = JSON.parse(resultado)});
}
