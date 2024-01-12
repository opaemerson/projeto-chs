function mostraRound() {
    const ativado = 1;

    const form = new FormData();
    form.append('ativado', ativado);

    const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/processar_round.php";

    $.ajax({
        url: url, 
        method: 'POST',
        data: form, 
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function (resultado) { 
            if (resultado.success) {
                $('#resultadoRound').html('Id: ' + resultado.mao);
                exibicao('#imagemRound1','#imagemRound2','#imagemRound3','#imagemRound4','#imagemRound5', resultado.imagem);
                $('#btnEquip1').show();
                $('#btnEquip2').show();
                $('#btnManipula').hide();
            }else{
                $('#resultadoRound').html('Erro: ' + resultado.message);
            } 
        },
        error: function (erro) {
            console.log(erro); 
        }
    });
}


function exibicao(um,dois,tres,quatro,cinco,imagens) {
    // Esconde todos os elementos de imagem
    $('.img-enviado').hide();

    if (!Array.isArray(imagens) || imagens.length === 0) {
        // Se não houver imagens, esconde o elemento principal
        $(um).hide();
        $(dois).hide();
        $(tres).hide();
        $(quatro).hide();
        $(cinco).hide();
    } else {
        // Exibe o elemento principal e define o src da primeira imagem
        $(um).attr('src', imagens[0]).show();
        $(dois).attr('src', imagens[1]).show();
        $(tres).attr('src', imagens[2]).show();
        $(quatro).attr('src', imagens[3]).show();
        $(cinco).attr('src', imagens[4]).show();
    }
}