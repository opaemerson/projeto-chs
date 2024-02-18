if (usuarioLogado) {
    document.getElementById('loginLi').style.display = 'none';
}

function verificarLogin() {
    if (!usuarioLogado) {
        window.location.href = 'login.php';
    } else {
        window.location.href = 'projeto_chs/index_chs.php';
    }
}

function verificarLoginMecanismo() {
    if (!permissaoUsuario && permissaoUsuario !== 'Amigo' && permissaoUsuario !== 'Admin') {
        alert("Voce nao possui permissao para acesso");
    } else {
        window.location.href = 'escolhe_ganolia.php';
    }
}

