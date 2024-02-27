if (usuarioLogado) {
    document.getElementById('loginLi').style.display = 'none';
}

function verificarLogin(projeto) {
    if (!usuarioLogado) {
        window.location.href = 'gobinc/login.php';
    } else {
        if(projeto == 'chs'){
            window.location.href = 'projeto_chs/index_chs.php';
        }

        if(projeto == 'ganolia'){
            window.location.href = 'gobinc/escolhe_ganolia.php';
        }
    }  
}

