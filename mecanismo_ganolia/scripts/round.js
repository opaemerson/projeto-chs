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
                $('#btnManipula').hide();
                exibicao('#imagemRound1','#imagemRound2','#imagemRound3','#imagemRound4','#imagemRound5', resultado.imagem);
                
                arrayMao = [];

                $('[id^=btnEquip]').remove();
                $('[id^=btnCombinar]').remove();

                let partes = resultado.mao.split(';');

                for (let i = 0; i < partes.length; i++) {
                    let valorInteiro = parseInt(partes[i], 10);
                    arrayMao.push(valorInteiro);
                }
                
                console.log(arrayMao);
                
                for (let i = 0; i < resultado.categoria.length; i++) {
                    if (resultado.categoria[i] == 'Ataque') {

                        let novoBotaoEquipar = $('<button>', {
                            id: `btnEquip${i + 1}`,
                            name: arrayMao[i],
                            text: 'Equipar',
                            style: 'margin-right: 50px;',
                            click: function() {
                                $(`#btnEquip${i + 1}`).css('background-color', 'green');
                                $(`#btnEquip${i + 1}`).removeAttr('onclick');                    
                                geraAtk(arrayMao[i]); 
                            }
                        });
                        
                        $('#jogar').append(novoBotaoEquipar);
                    }
                
                    if (resultado.categoria[i] == 'Moeda') {
                        // Criar o botão Combinar
                        let novoBotaoCombinar = $('<button>', {
                            id: `btnCombinar${i + 1}`,
                            name: arrayMao[i],
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
                    text: 'FINALIZAR MANIPULACAO',
                    style: 'position: relative; left: 200px; top: 20px;',
                    click: function() {
                        finalizaManipulacao();
                    }
                });
                $('#jogar').append(novoBotaoFinaliza);
                
                $('#btnFinaliza').show();
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

function geraAtk(atk){

    const form = new FormData();
    form.append('atk', atk);


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
                alert('pqp0');
            }else{
                alert('oi');
            } 
        },
        error: function (erro) {
            console.log(erro); 
        }
    });
}

function finalizaManipulacao(){
    const ativado = 1;
    
    const form = new FormData();
    form.append('ativado', ativado);

    const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/processar_finaliza_manipulacao.php";

    $.ajax({
        url: url, 
        method: 'POST',
        data: form, 
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function (resultado) { 
            if (resultado.success) {
                $('#imagemRound1, #imagemRound2, #imagemRound3, #imagemRound4, #imagemRound5').hide();
                $('#btnEquip1, #btnEquip2, #btnEquip3, #btnEquip4, #btnEquip5').hide();
                $('#btnCombinar1, #btnCombinar2, #btnCombinar3, #btnCombinar4, #btnCombinar5').hide();
                $('#btnFinaliza').hide();

                if (resultado.nome_criatura.length !== 0) {
                    let novoBotaoFinaliza = $('<button>', {
                        id: 'btnAtacar',
                        text: 'ATACAR',
                        style: 'position: relative; left: 10px; top: 60px;',
                        click: function() {
                            mostraAtaques(resultado.ataques, resultado.nome_criatura);
                        }
                    });
    
                    $('#jogar').append(novoBotaoFinaliza);
                } else{
                    let infoAtaque = $('<span>',{
                        text: 'VOCE NAO ALCANCE PARA NENHUMA CRIATURA PARA ATACAR!'
                    });
                    
                    $('#jogar').append(infoAtaque);
                }
                
                $('#qtdAtaque').html("Ataques disponíveis:" + resultado.quantidade + "<br><br><br>").show();
                

            }else{
                alert('erro1');
            } 
        },
        error: function (erro) {
            console.log(erro); 
        }
    });
}

function mostraAtaques(ataques, criaturas) {
    const arrayAtaques = ataques;

    const form = new FormData();
    form.append('arrayAtaques', arrayAtaques);

    const url = "http://127.0.0.1:80/chs/mecanismo_ganolia/processar_verifica_ataques.php";

    $.ajax({
        url: url, 
        method: 'POST',
        data: form, 
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function (resultado) { 
            if (resultado.success) {
                var modal = document.getElementById("modalAtaques");
                modal.style.display = "block";
            }else{
                alert('erro1');
            } 
        },
        error: function (erro) {
            console.log(erro); 
        }
    });
}

function closeModalAtaques() {
    var modal = document.getElementById("modalAtaques");
    modal.style.display = "none";
  }