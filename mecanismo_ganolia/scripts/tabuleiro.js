document.addEventListener("DOMContentLoaded", function () {
const gridContainer = document.getElementById("grid-container");
let allowMoves = true; // Controle de estado para permitir ou não movimentos
let jogadorPosition = { row: 0, col: 0 }; // Posição inicial do jogador

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



directions.forEach(direction => {
        const newRow = row + direction.row;
        const newCol = col + direction.col;

        const validMove = document.querySelector(`.grid-item[row="${newRow}"][col="${newCol}"]`);
        if (validMove) {
            validMove.classList.add("valid-move");
            validMove.addEventListener("click", handleValidMoveClick);
        }
    });
}

// Criar o grid
for (let i = 0; i < 8; i++) {
    for (let j = 0; j < 8; j++) {
        const gridItem = document.createElement("div");
        gridItem.classList.add("grid-item");
        gridItem.classList.add("white");
        gridItem.setAttribute("row", i);
        gridItem.setAttribute("col", j);

        gridContainer.appendChild(gridItem);

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
                const jogadorPosition = data; // Supondo que a resposta seja um objeto com as propriedades "row" e "col"

                // Adicionar o jogador na posição inicial
                jogadorPosition.row = parseInt(data.row, 10);
                jogadorPosition.col = parseInt(data.col, 10);
                
                if (i === jogadorPosition.row && j === jogadorPosition.col) {
                    gridItem.classList.add("player");
                    gridItem.style.backgroundColor = "red";

                    // Adicionar ouvinte de evento de clique ao jogador
                    gridItem.addEventListener("click", function () {
                        // Obter a posição do jogador
                        const currentPlayerRow = parseInt(this.getAttribute("row"));
                        const currentPlayerCol = parseInt(this.getAttribute("col"));

                        // Destacar os quadrados ao redor do jogador
                        highlightValidMoves(currentPlayerRow, currentPlayerCol, this);
                        allowMoves = true; // Permitir movimentos quando o jogador for clicado novamente
                        this.removeEventListener("click", arguments.callee); // Remover o ouvinte de evento de clique após o primeiro clique
                    });
                }
            })
            .catch(error => console.error("Erro na solicitação Ajax:", error));
    }
}

});
