const indexEnviado = [];

function mostraRound() {
    const ativado = 1;

    const form = new FormData();
    form.append('ativado', ativado);

    const url = "http://127.0.0.1:80/chs/ganolia_online/processar_round.php";

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


    const url = "http://127.0.0.1:80/chs/ganolia_online/processar_qtd_ataque.php";

    $.ajax({
        url: url, 
        method: 'POST',
        data: form, 
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function (resultado) { 
            if (resultado.success) {
                alert('Item equipado');
            }else{
                alert('Erro ao equipar item');
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

    const url = "http://127.0.0.1:80/chs/ganolia_online/processar_finaliza_manipulacao.php";

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

                $('#qtdAtaque').html("Ataques disponíveis:" + resultado.quantidade).show();

                console.log(resultado.nome_criatura);
                
                if (resultado.nome_criatura.length !== 0 && resultado.quantidade !== '') {
                    let novoBotaoFinaliza = $('<button>', {
                        id: 'btnAtacar',
                        text: 'COMBATE',
                        style: 'position: relative; left: 10px; top: 60px;',
                        click: function() {
                            mostraAtaques(resultado.ataques,resultado.imagens,resultado.nome_criatura);
                        }
                    });
    
                    $('#jogar').append(novoBotaoFinaliza);
                } else{
                    alert('Nao ha ataque disponivel');
                }
                
                let botaoFinish = $('<button>', {
                    id: 'btnFinish',
                    text: 'FINALIZAR ROUND',
                    style: 'position: relative; left: -85px; top: 100px;',
                    click: function() {
                        finish();
                    }
                });
                    
                $('#jogar').append(botaoFinish);

            }else{
                alert('erro1');
            } 
        },
        error: function (erro) {
            console.log(erro); 
        }
    });
}

function mostraAtaques(ataques,imagens,criaturas) {
    const arrayAtaques = ataques;

    const form = new FormData();
    form.append('arrayAtaques', arrayAtaques);

    const url = "http://127.0.0.1:80/chs/ganolia_online/processar_verifica_ataques.php";

    $.ajax({
        url: url, 
        method: 'POST',
        data: form, 
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function (resultado) { 
            if (resultado.success) {
                openModalAtaques();
                qtdImagem = 0;
                
                for (let i = 0; i < imagens.length; i++) {
                    if (imagens[i] === ';') {
                        qtdImagem++;
                    }
                }
                var imagensArray = imagens.split(";");
                var ataquesArray = ataques.split(";");

                if (criaturas.length !== 0) {
                    let formulario = $('<form>');

//CONTAINER RELACIONADO A SELE��O DE CRIATURAS
                let selectCriatura = $('<select>', {
                    id: 'selectCriatura',
                });

                for (let i = 0; i < criaturas.length; i++) {
                    $('<option>', {
                        value: criaturas[i].id_criatura,
                        text: criaturas[i].nome_criatura,
                    }).appendTo(selectCriatura);
                }

                selectCriatura.appendTo(formulario);

//CONTAINER RELACIONADO A IMAGEM
                    let containerImagens = $('<div>')

                    for (let i = 0; i < qtdImagem; i++) {
                        let imagem = $('<img>', {
                            id: 'idImage' + i,
                            src: imagensArray[i],
                            value: ataquesArray[i],
                    
                            click: (function(index) {
                                return function() {
                                    const ataqueAtual = ataquesArray[index];
                                    const indexAtual = index;
                                    console.log(indexAtual);
                    
                                    if (!indexEnviado.includes(parseInt(indexAtual))) {
                                        console.log('index enviado ' + indexEnviado);
                                        
                                        $('img').css('border', 'none');
                                        $(this).css('border', '5px solid green');
                    
                                        inputAtaqueSelecionado.val(ataqueAtual);
                                        inputIndexSelecionado.val(indexAtual);
                                    }
                                };
                            })(i)
                        });

                        imagem.appendTo(containerImagens);

                        imagem.css({
                            'width': '50px',
                            'height': '120px',
                            'margin-bottom': '20px',
                            'margin-right': '10px',
                            'margin-top': '10px'
                        });
                    }
                    containerImagens.appendTo(formulario);

                    let inputAtaqueSelecionado = $('<input>', {
                        type: 'hidden',
                        name: 'ataqueSelecionado',
                    });
            
                    inputAtaqueSelecionado.appendTo(formulario);

                    let inputIndexSelecionado = $('<input>', {
                        type: 'hidden',
                        name: 'indexSelecionado',
                    });
            
                    inputIndexSelecionado.appendTo(formulario);



//BOTAO SUBMIT DO MODAL DE ATAQUE
                    let btnSubmit = $('<button>', {
                        type: 'submit',
                        text: 'Atacar',
                    });

                    btnSubmit.appendTo(formulario);

                    formulario.on('submit', function(event) {
                        event.preventDefault(); 
                        let idCriaturaSeleccionada = selectCriatura.val();
                        let ataqueSelecionado = inputAtaqueSelecionado.val();
                        let indexSelecionado = inputIndexSelecionado.val();

                        console.log('Index enviado para submit: ' + indexSelecionado);

                        indexEnviado.push(parseInt(indexSelecionado));
                        concessaoAtk(idCriaturaSeleccionada, ataqueSelecionado);

                    });

                    let botaoClose = $('<span>', {
                        class: 'close',
                        text: 'X',
                        click: function () {
                            closeModalAtaques();
                        }
                    });

//APLICANDO TODO CONTE�DO DENTRO DO MODAL
                    $('#modal-do-ataque').append(botaoClose);
                    $('#modal-do-ataque').append(formulario);

                    $('#modal-do-ataque').css({
                        'display': 'flex',
                        'flexDirection': 'column',
                        'alignItems': 'center',
                        'justifyContent': 'flex-start',
                    });
                }                
            }else{
                alert('erro1');
            } 
        },
        error: function (erro) {
            console.log(erro); 
        }
    });
}

function concessaoAtk(criatura, itemAtaque){
    const form = new FormData();
    form.append('criatura', criatura);
    form.append('itemAtaque', itemAtaque);

    const url = "http://127.0.0.1:80/chs/ganolia_online/processar_ataque.php";

    $.ajax({
        url: url, 
        method: 'POST',
        data: form, 
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function (resultado) { 
          if (resultado.success) {

            var danoConcedido = resultado.damageAleatorio;

            if (danoConcedido !== ''){
                alert('-' + danoConcedido + ' de HP em ' + resultado.criatura);
            } else{
                alert(resultado.criatura + '[defendeu]');
            }

            if (resultado.kill == 1) {
                recolheDrop(resultado.id_criatura);
            }

            $('#qtdAtaque').html("Ataques disponiveis:" + resultado.quantidade).show();

            $('#info-sessao').hide();
            let info_sessao_js = $('#info_js').empty();

            for (let i = 0; i < resultado.array_nome_personagem.length; i++) {

                const labelNomePersonagem = $('<label>').text(resultado.array_nome_personagem[i]);
                const labelHpPersonagem = $('<label>').text(resultado.array_hp_personagem[i]);
  
                info_sessao_js.show();

                info_sessao_js.append(labelNomePersonagem);
                info_sessao_js.append('<br>');

                info_sessao_js.append(
                    $('<img>').attr({
                        'src': '../Images/Ganolia/Icons/coracao.png',
                        'width': '30px',
                        'height': '30px'
                    }).addClass('icone-coracao')
                );

                info_sessao_js.append(labelHpPersonagem);
                info_sessao_js.append('<br>');
            }

            for (let i = 0; i < resultado.array_nome_criatura.length; i++) {
                const labelNomeCriatura = $('<label>').text(resultado.array_nome_criatura[i]);
                const labelHpCriatura = $('<label>').text(resultado.array_hp_criatura[i]);

                info_sessao_js.show();
            
                info_sessao_js.append(labelNomeCriatura);
                info_sessao_js.append('<br>');

                info_sessao_js.append(
                    $('<img>').attr({
                        'src': '../Images/Ganolia/Icons/coracao.png',
                        'width': '30px',
                        'height': '30px'
                    }).addClass('icone-coracao')
                );

                info_sessao_js.append(labelHpCriatura);
                info_sessao_js.append('<br>');
            }

            info_sessao_js.show();

            closeModalAtaques();
            
          } else {
            alert('Nao ha ataques disponiveis');
            console.error('[js] - Erro ao realizar ataque.');
          }
        },
        error: function (erro) {
          console.log(erro); 
        }
      });
}

function recolheDrop(criatura) {
  
    const form = new FormData();
    form.append('criatura', criatura);
  
    const url = "http://127.0.0.1:80/chs/ganolia_online/processar_recolher_drop.php";
  
    $.ajax({
      url: url, 
      method: 'POST',
      data: form, 
      processData: false, 
      contentType: false,
      dataType: 'json',
      success: function (resultado) { 
        if (resultado.success) {
            alert('Voce matou o alvo');
            alert('O Alvo dropou: \n' +  'Nome: ' + resultado.nomeEscolhido + '\nRaridade: ' + resultado.raridadeEscolhido);
  
        } else {
            console.log('erro no js do buscar drop');
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
    $('#modal-do-ataque').empty();
}

function openModalAtaques() {
    var modal = document.getElementById("modalAtaques");
    modal.style.display = "block";
}

function finish(){
    const ativo = 1;

    const form = new FormData();
    form.append('ativo', ativo);

    const url = "http://127.0.0.1:80/chs/ganolia_online/processar_fim_round.php";

    $.ajax({
        url: url, 
        method: 'POST',
        data: form, 
        processData: false, 
        contentType: false,
        dataType: 'json',
        success: function (resultado) { 

            if(resultado.correto == 1){
                window.location.reload();
            } else{
                alert('Erro no js do fim de round')
            }

        },
        error: function (erro) {
            console.log(erro); 
        }
    });
}