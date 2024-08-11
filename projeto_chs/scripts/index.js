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