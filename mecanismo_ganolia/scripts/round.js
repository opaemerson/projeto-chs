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
                
                arrayMao = [];
                console.log(resultado.categoria);
                
                // Remover os botões existentes
                $('[id^=btnEquip]').remove();
                $('[id^=btnCombinar]').remove();
                
                for (let i = 0; i < resultado.categoria.length; i++) {
                    if (resultado.categoria[i] == 'Ataque') {
                        // Criar o botão Equipar
                        let novoBotaoEquipar = $('<button>', {
                            id: `btnEquip${i + 1}`,
                            name: arrayMao[i],
                            text: 'Equipar',
                            style: 'margin-right: 50px;',
                            click: function() {
                                // Lógica a ser executada quando o botão é clicado
                                mostraName(); // Substitua pela lógica desejada
                            }
                        });
                        
                        $('#jogar').append(novoBotaoEquipar);
                    }
                
                    if (resultado.categoria[i] == 'Moeda') {
                        // Criar o botão Combinar
                        let novoBotaoCombinar = $('<button>', {
                            id: `btnCombinar${i + 1}`,
                            text: 'Combinar',
                            style: 'margin-right: 50px;',
                            click: function() {
                                // Lógica a ser executada quando o botão é clicado
                            }
                        });
                        
                        $('#jogar').append(novoBotaoCombinar);
                    }
                }
                
                let novoBotaoFinaliza = $('<button>', {
                    id: 'btnFinaliza',
                    text: 'FINALIZAR MANIPULAÇÃO',
                    style: 'position: relative; left: 200px; top: 20px;',
                    click: function() {
                        // Lógica a ser executada quando o botão é clicado
                    }
                });
                $('#jogar').append(novoBotaoFinaliza);
                
                $('#btnFinaliza').show();
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

function mostraName(){
    const ativo = 1;


    const form = new FormData();
    form.append('ativo', ativo);


    const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/processar_qtd_ataque.php";

    $.ajax({
        url: url, 
        method: 'POST',
        data: form, 
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function (resultado) { 
            if (resultado.success) {

            }else{
                alert('oi');
            } 
        },
        error: function (erro) {
            console.log(erro); 
        }
    });

    btnEquip1.css('background-color', 'green');
    btnEquip1.removeAttr('onclick');
}