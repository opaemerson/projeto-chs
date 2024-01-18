document.addEventListener("DOMContentLoaded", function () {
let gridContainer = document.getElementById("grid-container");
let allowMoves = true; // Controle de estado para permitir ou não movimentos
let jogadorPosition = { row: 0, col: 0 }; // Posição inicial do jogador
let portalPosition = { row: 0, col: 0};
let aliadoRepetido = [];
let criaturaRepetido = [];

function highlightValidMoves(row, col, currentPlayerSquare) {
    const directions = [
        { row: -1, col: 0 }, // acima
        { row: 1, col: 0 },  // abaixo
        { row: 0, col: -1 }, // à esquerda
        { row: 0, col: 1 }   // à direita
    ];

    // Remover a classe "valid-move" e os ouvintes de evento de clique de todos os quadrados
    document.querySelectorAll(".grid-item").forEach(item => {
        item.removeEventListener("click", handleValidMoveClick);
});

function handleValidMoveClick() {
    if (allowMoves) {
        // Mover o jogador para o quadrado clicado
        movePlayer(currentPlayerSquare, this);

        // Atualizar a posição do jogador
        jogadorPosition.row = parseInt(this.getAttribute("row"));
        jogadorPosition.col = parseInt(this.getAttribute("col"));

        allowMoves = false; // Impedir movimentos adicionais até a próxima vez que o jogador for clicado
    }
}

function movePlayer(currentPlayerSquare, targetSquare) {
    // Verificar se o jogador está sendo movido para um novo quadrado
    if (currentPlayerSquare !== targetSquare) {
        // Mover o jogador para o novo quadrado
        targetSquare.classList.add("player");
        targetSquare.style.backgroundColor = "red";

        // Remover o jogador do quadrado antigo
        currentPlayerSquare.classList.remove("player");
        currentPlayerSquare.style.backgroundColor = ""; // Remover a cor de fundo do quadrado antigo

        // Remover todos os quadrados verdes e eventos de clique
        document.querySelectorAll(".valid-move").forEach(validMoveSquare => {
            validMoveSquare.classList.remove("valid-move");
            validMoveSquare.removeEventListener("click", handleValidMoveClick);
        });

        const currentPlayerRow = parseInt(targetSquare.getAttribute("row"));
        const currentPlayerCol = parseInt(targetSquare.getAttribute("col"));

        // Atualizar a posição no banco de dados
        updatePositionInDatabase(currentPlayerRow, currentPlayerCol);

        if(currentPlayerRow === portalPosition.row && currentPlayerCol === portalPosition.col){
            updatePositionTerritorio(currentPlayerRow, currentPlayerCol);
            inicializa();
        }

        setTimeout(function() {
            window.location.reload();
        }, 2000);        

        // Adicionar ouvinte de evento de clique ao novo quadrado do jogador
        targetSquare.addEventListener("click", function () {
        // Obter a posição do jogador
        const currentPlayerRow = parseInt(this.getAttribute("row"));
        const currentPlayerCol = parseInt(this.getAttribute("col"));
 
        // Destacar os quadrados ao redor do jogador
        highlightValidMoves(currentPlayerRow, currentPlayerCol, this);
        allowMoves = true; // Permitir movimentos quando o jogador for clicado novamente
        this.removeEventListener("click", arguments.callee); // Remover o ouvinte de evento de clique após o primeiro clique

        });
    }
}

function updatePositionTerritorio(row, col) {
    // Criar um objeto com os dados a serem enviados para o servidor
    const newRow = row;
    const newCol = col;

    const formData = new FormData();
    formData.append('newRow', newRow);
    formData.append('newCol', newCol);

    // Fazer a requisição AJAX para update_posicao.php
    fetch('http://127.0.0.1:80/chs/mecanismo_ganolia/processar_update_posicao_t.php', {
        method: 'POST',
        body: formData,  // Não é mais necessário usar JSON.stringify
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta do servidor (update_posicao.php):', data);
    })
    .catch(error => {
        console.error('Erro na requisição (update_posicao.php):', error);
    });
}


function updatePositionInDatabase(row, col) {
    // Criar um objeto com os dados a serem enviados para o servidor
    const newRow = row;
    const newCol = col;

    const formData = new FormData();
    formData.append('newRow', newRow);
    formData.append('newCol', newCol);

    // Fazer a requisição AJAX para update_posicao.php
    fetch('http://127.0.0.1:80/chs/mecanismo_ganolia/processar_update_posicao.php', {
        method: 'POST',
        body: formData,  // Não é mais necessário usar JSON.stringify
    })
    .then(response => response.json())
    .then(data => {
        console.log('Resposta do servidor (update_posicao.php):', data);
    })
    .catch(error => {
        console.error('Erro na requisição (update_posicao.php):', error);
    });
}

directions.forEach(direction => {
        const newRow = row + direction.row;
        const newCol = col + direction.col;

        const validMove = document.querySelector(`.grid-item[row="${newRow}"][col="${newCol}"]`);
        if (validMove) {
            validMove.classList.add("valid-move");
            validMove.style.backgroundColor = "green";
            validMove.addEventListener("click", handleValidMoveClick);
        }
    });
}

function criarGrid(cores, vez, territorio, portalRow, portalCol, jogadorRow, jogadorCol){
    for (let i = 0; i < 9; i++) {
        for (let j = 0; j < 9; j++) {
            const gridItem = document.createElement("div");
            gridItem.classList.add("grid-item");
            gridItem.classList.add("white");
            gridItem.setAttribute("row", i);
            gridItem.setAttribute("col", j);

            gridContainer.appendChild(gridItem);

            buscaCores(cores, territorio);
            buscaPortal(territorio, portalRow, portalCol);
            buscaAliado(vez, territorio);
            buscaJogador(vez, territorio, jogadorRow, jogadorCol);
        }
    }
}

function buscaJogador(vez, territorio, row, col){
    if(vez === 'A'){
        const jogadorElement = document.querySelector(`[row="${row}"][col="${col}"]`);
    
        if (jogadorElement) {
            jogadorElement.classList.add("player");
            jogadorElement.style.backgroundColor = "red";

            // Adicionar ouvinte de evento de clique ao jogador
            jogadorElement.addEventListener("click", function () {
            // Obter a posição do jogador
            const currentPlayerRow = parseInt(this.getAttribute("row"));
            const currentPlayerCol = parseInt(this.getAttribute("col"));

            // Destacar os quadrados ao redor do jogador
            highlightValidMoves(currentPlayerRow, currentPlayerCol, this);
            allowMoves = true; // Permitir movimentos quando o jogador for clicado novamente
            this.removeEventListener("click", arguments.callee); // Remover o ouvinte de evento de clique após o primeiro clique  
            });
        }
    } else{
        const jogadorElement = document.querySelector(`[row="${row}"][col="${col}"]`);
    
        if (jogadorElement) {
            jogadorElement.classList.add("player");
            jogadorElement.style.backgroundColor = "purple";
            buscaAliado(vez,territorio);
        }
    }
}

function buscaCores(cores, territorio) {
    const arrayTerritorio1 = [
        { row: 0, col: 1 },
        { row: 1, col: 0 },
        { row: 0, col: 0 }
    ];

    if(territorio == 1){
        for (const posicao of arrayTerritorio1) {
            const { row, col } = posicao;
    
            // Verificando se a cor está presente nas cores fornecidas
            if (cores[row] && cores[row][col]) {
                const corElement = document.querySelector(`[row="${row}"][col="${col}"]`);
                
                // Verificando se o elemento foi encontrado
                if (corElement) {
                    corElement.style.backgroundColor = "blue";
                }
            }
        }
    }

}

function buscaPortal(territorio, portalRow, portalCol) {

    if(territorio === 1){
        if(portalRow && portalCol){
            const portalElement = document.querySelector(`[row="${portalRow}"][col="${portalCol}"]`);
    
            if (portalElement) {
                portalElement.style.backgroundColor = "yellow";
            }
        }
    }

    if(territorio === 2){
        if(portalRow && portalCol){
            const portalElement = document.querySelector(`[row="${portalRow}"][col="${portalCol}"]`);
    
            if (portalElement) {
                portalElement.style.backgroundColor = "yellow";
            }
        }
    }

}

function buscaAliado(vez,territorio){
    const newVez = vez;

    const formData = new FormData();
    formData.append('newVez', newVez);

    // Fazer a requisição AJAX para update_posicao.php
    fetch('http://127.0.0.1:80/chs/mecanismo_ganolia/processar_busca_aliado.php', {
        method: 'POST',
        body: formData,  // Não é mais necessário usar JSON.stringify
    })
    .then(response => response.json())
    .then(data => {
        if (data.success){
            

            data.data.forEach(item => {
                // Verifica se o item já foi processado
                if (!aliadoRepetido.includes(item.personagem) || !criaturaRepetido.includes(item.criatura)) {
                    // Adiciona o item ao array de itens processados
                    aliadoRepetido.push(item.personagem);
                    criaturaRepetido.push(item.criatura);

                    if(territorio == item.territorio){
                    const aliadoElement = document.querySelector(`[row="${item.row}"][col="${item.col}"]`);
                    
                    if(vez == 'A'){
                        aliadoElement.style.backgroundColor = "purple";
                    } else{
                        aliadoElement.style.backgroundColor = "red";
                    }

                    if(item.vez == 'A'){
                        aliadoElement.style.backgroundColor = "red";
                    } else{
                        aliadoElement.style.backgroundColor = "purple";
                    }

                    if(item.personagem == 99){
                        aliadoElement.style.backgroundColor = "orange";
                    }

                    }
                }
            });
        }else {
            console.error('Erro na requisição JS:', data.message);
        }
    })
    .catch(error => {
        console.error('Erro na requisição:', error);
    });
}

function inicializa(){
    // Fazer uma solicitação Ajax para obter a posição do jogador
    fetch('http://127.0.0.1:80/chs/mecanismo_ganolia/processar_busca_posicao.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(jogadorPosition),
})
.then(response => response.json())
.then(data => {
        const jogadorPosition = data[0];
            
        // Aplicar a função de conversão a cada propriedade
        jogadorPosition.player = parseInt(jogadorPosition.player);
        jogadorPosition.vez = jogadorPosition.vez;
        jogadorPosition.territorio = parseInt(jogadorPosition.territorio);
        jogadorPosition.row = parseInt(jogadorPosition.row);
        jogadorPosition.col = parseInt(jogadorPosition.col);


        if(jogadorPosition.territorio === 1){
            portalPosition.row = 8;
            portalPosition.col = 8;
            var cores = {};

            for (let i = 0; i < 9; i++) {
                for (let j = 0; j < 9; j++) {
                    if (!cores[i]) {
                        cores[i] = {};
                    }
                    cores[i][j] = { row: i, col: j };
                }
            }

            criarGrid(cores, jogadorPosition.vez, jogadorPosition.territorio, portalPosition.row, portalPosition.col, jogadorPosition.row, jogadorPosition.col);
        }

        else if(jogadorPosition.territorio === 2){
            portalPosition.row = 2;
            portalPosition.col = 2;
            criarGrid(cores, jogadorPosition.vez, jogadorPosition.territorio, portalPosition.row, portalPosition.col, jogadorPosition.row, jogadorPosition.col);
        }
})
    .catch(error => console.error("Erro na solicitação Ajax:", error));
}

inicializa();

});
