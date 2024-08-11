document.addEventListener('DOMContentLoaded', function() {
  var editModal = document.getElementById('editModal');

  editModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget;
      var tagOriginal = button.getAttribute('data-tagOriginal');
      var marcaOriginal = button.getAttribute('data-marcaOriginal');
      var problemaOriginal = button.getAttribute('data-problemaOriginal');

      var equipamentoId = button.getAttribute('data-equipamentoId');
      var editTag = document.getElementById('editTag');
      var editModelo = document.getElementById('editModelo');
      var editProblema = document.getElementById('editProblema');

      $('select[id="editEquipamento"]').val(equipamentoId);
      editTag.value = tagOriginal;
      editModelo.value = marcaOriginal;
      editProblema.value = problemaOriginal;

  });
});

function formatarData(data) {
  const partes = data.split('-');
  const dia = partes[2];
  const mes = partes[1];
  const ano = partes[0];
  return dia + '/' + mes + '/' + ano;
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
        if(resultado.erro == 1){
          alert(resultado.mensagem);
        } else {
          alert(resultado.mensagem);
          window.location.reload();
        }
      },
      error: function (erro) {
        console.log(erro);
      }
    });
  }
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

function alterarEvento(tag, acao) {


  if (confirm('Deseja realmente ' + acao + ' este item?')) {
    const url = 'http://127.0.0.1/portfolio/projeto_chs/servicos/editar.php';

    $.ajax({
      url: url,
      method: 'POST',
      data: {
        tag: tag,
        editSituacao: acao,
        ajax: 'ajax'
      },
      dataType: 'json',
      success: function (resultado) {
        if (resultado.erro) {
          alert(resultado.mensagem)
        } else {
          alert("Item alterado!")
          window.location.reload();
        }

      },
      error: function (erro) {
        console.log(erro);
      }
    });
  }
}

function validaCadastro(){
  var tag = document.getElementById('tag').value;
  var modelo = document.getElementById('modelo').value;
  var problema = document.getElementById('problema').value;
  var situacao = $('select[name="situacao"]').val();
  
  if (!tag || tag == '') {
      alert('Opção tag não pode ser vazia');
      return false;
  }

  if (!modelo || modelo == 0) {
      alert('Opção marca não pode ser vazia');
      return false;
  }
  
  if (!problema || problema == 0) {
      alert('Opção problema não pode ser vazia');
      return false;
  }
  
  if (!situacao || situacao == 0) {
      alert('Opção situação não pode ser vazia');
      return false;
  }

  return true;
  
}

function validaEdicao(){
  var tag = document.getElementById('editTag').value;
  var modelo = document.getElementById('editModelo').value;
  var problema = document.getElementById('editProblema').value;
  var situacao = $('select[name="editSituacao"]').val();
  
  if (!tag || tag == '') {
      alert('Opção tag não pode ser vazia');
      return false;
  }

  if (!modelo || modelo == 0) {
      alert('Opção modelo não pode ser vazia');
      return false;
  }
  
  if (!problema || problema == 0) {
      alert('Opção problema não pode ser vazia');
      return false;
  }
  
  if (!situacao || situacao == 0) {
      alert('Opção situação não pode ser vazia');
      return false;
  }

  return true;
  
}

function mensagemErro(acao){
  if(acao == 'incompleto'){
    alert('Função ainda não implementada!');
    return false;
  }

  return false;

}
