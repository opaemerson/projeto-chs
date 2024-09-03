if (usuarioLogado) {
    document.getElementById('loginLi').style.display = 'none';
}

function verificarLogin(projeto) {
    if (!usuarioLogado) {
        window.location.href = 'login.php';
    } else {
        if(projeto == 'chs'){
            window.location.href = 'projeto_chs/index.php';
        }
    }  
}

