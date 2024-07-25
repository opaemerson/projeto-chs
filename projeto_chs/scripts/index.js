const tbody = document.querySelector(".listar_usuarios");

const listarUsuarios = async () => {
  const dados = await fetch("./listar.php", {
    method: "GET",
  });
  const resposta = await dados.text();
  tbody.innerHTML = resposta;
};

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
  const id_equip = $('#id_equip').val();

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
  form.append('id_equip', id_equip);

  const url = "http://127.0.0.1/portfolio/projeto_chs/cadastro.php";

  $.ajax({
    url: url, // URL da requisição
    method: 'POST', // Método HTTP usado na requisição
    data: form, 
    processData: false, 
    contentType: false, 
    success: function (resultado) { 
      console.log(resultado); 
      location.reload();
    },
    error: function (erro) { // Função de callback em caso de erro na requisição
      console.log(erro); // Exibe o erro no console
    }
  });

}

function remove(id, idUsuario, usuarioSessao, permissaoSessao) {
  if (confirm('Deseja realmente excluir este item?')) {
    const url = 'http://127.0.0.1/portfolio/projeto_chs/servicos/remove.php';

    $.ajax({
      url: url,
      method: 'POST',
      data: {
        id: id,
        idUsuario: idUsuario,
        usuarioSessao: usuarioSessao,
        permissaoSessao: permissaoSessao
      },
      dataType: 'json',
      success: function (resultado) {
        if (resultado.erro) {
          alert(resultado.mensagem)
        } else {
          alert("Item removido")
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
  var form = new FormData();
  form.append('id', id); 

  const url = "http://127.0.0.1/portfolio/projeto_chs/ler.php"; 

  $.ajax({
    url: url, 
    method: "POST", 
    data: form,
    processData: false, 
    contentType: false,
    success: function (data) { 
      window.localStorage.setItem('user', JSON.stringify(data));
      console.log(data);
      abrirModalEdicao(); 
    }
  });
}

function abrirModalEdicao() {
  var userData = JSON.parse(window.localStorage.getItem('user')); 
  userData = JSON.parse(userData); 
  var editIdInput = document.getElementById('editId'); 
  var editTagInput = document.getElementById('editTag'); 
  var editModeloInput = document.getElementById('editModelo'); 
  var editProblemaInput = document.getElementById('editProblema');
  var editDataEnvio = document.getElementById('editDataEnvio');
  var editSituacao = $('select[name="editSituacao"]');
  var editEquip = $('select[name="editEquipamento"]');

  editIdInput.value = userData[0]['ID'];
  editTagInput.value = userData[0]['TAG']; 
  editModeloInput.value = userData[0]['MODELO'];
  editProblemaInput.value = userData[0]['PROBLEMA'];
  editDataEnvio.value = userData[0]['DATA_ENVIO'];
  var selecionarSituacao = userData[0]['SITUACAO'];
  var selecionarEquip = userData[0]['EQUIPAMENTO'];

  editEquip.val(selecionarEquip);
  editSituacao.val(selecionarSituacao);
}

function editarUsuario() {
  const id = document.getElementById('editId').value;
  const tag = document.getElementById('editTag').value;
  const opcao = document.getElementById('editModelo').value;
  const problema = document.getElementById('editProblema').value;
  const data_envio = document.getElementById('editDataEnvio').value;
  const idEquip = $('select[name="editEquipamento"]').find(':selected').attr('data-id');
  const situacao = $('select[name="editSituacao"]').val();

  var form = new FormData();
  form.append('id', id);
  form.append('tag', tag);
  form.append('modelo', opcao);
  form.append('problema', problema);
  form.append('idEquip', idEquip)
  form.append('data_envio', data_envio);
  form.append('situacao', situacao);

  const url = "http://127.0.0.1/portfolio/projeto_chs/servicos/editar.php";

  $.ajax({
    url: url,
    method: "POST",
    data: form,
    processData: false,
    contentType: false,
    success: function (response) {
      location.reload();
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

function pesquisar() {
  const procurarPalavra = document.getElementById('searchInput').value;

  if (!procurarPalavra || procurarPalavra.trim() == ''){
    listarUsuarios(1);
    return;
  }

  const form = new FormData();
  form.append('procurarPalavra', procurarPalavra);

  const url = "http://127.0.0.1/portfolio/projeto_chs/pesquisar.php";

  $.ajax({
    url: url,
    method: 'POST',
    data: form,
    processData: false,
    contentType: false,
    success: function (resultado) {
      resultado = JSON.parse(resultado);
      console.log(resultado);


      $('.listar_usuarios').empty();

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
          html: `<img src='../Images/CHS/editar.png' width='30' height='30' alt='Editar'>`,
          click: function () {
            lerUsuario(obj.id);
          },
        });

        const deleteButton = $("<button>", {
          type: "button",
          class: "btn btn-link",
          html: `<img src='../Images/CHS/excluir.png' width='30' height='30'alt='Excluir'>`,
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
  const situacaoOption = $('select[name="situacaoFiltro"]');
  const procurarSituacao = situacaoOption.val();

  const form = new FormData();
  form.append('procurarModelo', procurarModelo);
  form.append('procurarProblema', procurarProblema);
  form.append('procurarSituacao', procurarSituacao);

  const url = "http://127.0.0.1/portfolio/projeto_chs/servicos/filtrar.php";

  $.ajax({
    url: url,
    method: 'POST',
    data: form,
    processData: false,
    contentType: false,
    success: function (resultado) {
      resultado = JSON.parse(resultado);
      console.log(resultado);

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
          const marca = obj['modelo'];
          const problema = obj['problema'];
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
            html: `<img src='../Images/CHS/editar.png' width='30' height='30' alt='Editar'>`,
            click: function () {
              lerUsuario(obj.id);
            },
          });

          const deleteButton = $("<button>", {
            type: "button",
            class: "btn btn-link",
            html: `<img src='../Images/CHS/excluir.png' width='30' height='30'alt='Excluir'>`,
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

        $('.listar_usuarios').append(table);
      }
    },
    error: function (erro) {
      console.log("Erro na requisição: ", erro);
    }
  }).done(function (resultado) {
    resultado = JSON.parse(resultado)
  });
}

function validaPermissaoCategoria(permissao) {
  if (permissao === "Admin") {
    window.location.href = "incluir_categoria.php";
  } else {
    alert("Voce nao tem permissao para executar esta acao.");
  }
}

function concluirEvento(tagId) {
  if (confirm('Deseja realmente concluir este item?')) {
    const url = 'http://127.0.0.1/portfolio/projeto_chs/servicos/concluir.php';

    $.ajax({
      url: url,
      method: 'POST',
      data: {
        tagId: tagId
      },
      dataType: 'json',
      success: function (resultado) {
        console.log('a');
        if (resultado.erro) {
          alert(resultado.mensagem)
        } else {
          alert("Item concluido")
          location.reload();
        }

      },
      error: function (erro) {
        console.log(erro);
      }
    });
  }
}
