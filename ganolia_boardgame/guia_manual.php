<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia de Ganolia</title>
    <link rel="stylesheet" href="../css/rpg.css">
    <style>
    body {
    background-image: url('../Images/Ganolia/bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    }
</style>
</head>
<body>
<div>
  <img src="../Images/Ganolia/TESTING.jpg" alt="" style="width: 150mm; padding: 10mm;">
</div>
<a href="index.php">Voltar</a>
<div class="two-columns">
    <p class="dropcap">
    Ganolia sera um Dungeon Crawler com um formato hibrido que combina elementos de boardgame com um aplicativo interativo, 
    oferecendo aos jogadores a experiencia de explorar o vasto territorio de ganolia em um tabuleiro fisico, com miniaturas e dados, 
    enquanto gerenciam suas cartas virtuais para construir o deck perfeito.
    </p>

    <!--## topico 01 ##-->
    <h2>Ciclo de Turno</h2>
    <p>Na ordem da pessoa mais jovem para a mais velha, os personagens jogam antes dos monstros.</p>
    <p>Após realizar suas ações, todos os seus itens serão movidos para a pilha de descarte e, em seguida, pegue 5 novas cartas. 
    Quando sua pilha de Privilégios estiver vazia, embaralhe e inicie o ciclo novamente.</p>
    <p>Depois que todos os jogadores terminam suas ações, os monstros agem um de cada vez, indicando qual jogador estão seguindo 
    e atacando, se estiverem ao alcance.</p>
    
    <p>
    Cada jogador, ao ingressar na partida, sera atribuido com um conjunto inicial de cartas, 
    O jogo ira conter um mapa pre-definido, desenhado sob um gradiente, que servira como casas para as miniaturas.
    </p>

    <h2>Objetivo - Vencer por pontuação</h2>

    <h4>Pontuação por Conquistas</h4>
    <p>Cada equipamento possui sua própria pontuação, portanto ao final do jogo
      soma-se a quantidade total de seu baralho.
    <br><b>Importante: </b>
    Derrotar os semi-boss spawnado, ganha um item especial que equivale em média X pontos.
    <br>Derrotar o boss spawnado, ganha um item especial que equivale em média X pontos
    
    <h4>Pontuação de Gladiador</h4>
    <p>Vencer outro jogador no evento Gladiador, ganha 01 token que equivale a X pontos. </p>

    <h4>Pontuação da Fabricação</h4>
    <p>Acumular a maior quantidade de um recurso específico (X) no estoque.
    O jogador com a maior quantidade desse recurso ao final do jogo ganha X pontos.</p>

    <h4>Negativação de pontuação</h4>
    <p>Ocorre quando seu personagem é morto dentro do jogo, ganha um marcador de caveira que 
      equivale a -X pontos</p>

    <!-- topico adicional -->
    <h2>Quando jogo acaba?</h2>
    <p></p>

    <!--## topico 03 ##-->
    <h2>Diferenciais do jogo</h2>
    <ul>

    <li>  
    <p>Buildeck integrado com esquema de classes.</p>
    </li>

    <li>
    <p>Dois modos ativos para serem jogados, coop ou individual.</p>
    </li>

    <li>
    <p>Formato de encantar itens para agregar a sua biblioteca particular.</p>
    </li>

    <li>
      <p>Integração com aplicativo</p>
    </li>
    </ul>
    

    <!--## topico 04 ##-->
    <h2>O que seria a Biblioteca?</h2>

    <p>Este é o local de consulta na qual contém tanto as cartas de monstros quanto as de personagens que foram adquiridos. </p>
    <p>Sua biblioteca funciona como um catálogo de colecionáveis, permitindo que você utilize suas conquistas em qualquer partida 
    que iniciar.</p>
 
    <!--## topico 06 ##-->
    <h2>Ações</h2>
    Coletar 05 cartas de seu baralho de privilegios, destas cartas voce pode fazer as seguintes ações:
    <ul>
      <li>
          <b>Equipar-se:</b> Inserir as cartas de Ataque/Defesa em seus slots.
        </li>
        <li>
          <b>Comprar/Fabricação:</b> Combine materiais para criar equipamentos. Após a criação, coloque a nova carta no baralho 
          de descarte.
        </li>
        <li>
          <b>Banimento:</b> Exclusao de qualquer carta indesejado de seu baralho, descartando a mesma para o mercado.
        </li>
        <li>
        <p><b>Andar:</b>Essa ação é de acordo com número de movimento do seu personagem, permitirá que você chegue mais 
        perto do seu alvo ou recue de algum adversário</p>
        </li>
    </ul>
        
    <!--## topico 07 ##-->
    <h3>Moedas</h3>
    <p>Com a usabilidade de combinar as células necessárias para a troca de itens na loja.</p>

    <!--## topico 08 ##-->
    <h3>Fabricação</h3>
    <p> São cartas que podem ser elaboradas ao surgir no centro de compras </p>
    <p>A combinação de materiais comuns geralmente resulta na criação de equipamento, que pode ser utilizado para proteção ou ataque.</p>

    <!--## topico 09 ##-->
    <h3>Equipamentos</h3>
    <p>Os equipamentos estão divididos em várias categorias de raridade, e essa raridade pode influenciar os atributos do equipamento.</p>
    <p>Os equipamentos têm classificações que correspondem aos seus preços, seguindo uma escala de preços de acordo com a raridade.</p>
    <p>Cada personagem utiliza um item de acordo com sua classe.</p>
    <p>Cada carta especifica quantos dados e que tipo de dado o equipamento utiliza, podendo variar de um D6 a um D12.</p>

    <!--##  topico 10 ##-->
    <h3>Loja Comum</h3>
    <p>São itens que ficam fixados em mesa, contendo cinco cartas disponiveis para compra, podendo ser embaralhada a cada X rodadas 
      e sendo resposta a cada compra efetuada.</p>
    
    <!--##  topico 11 ##-->
    <h3>Loja Especial</h3>
    <p>São venda de itens exclusivos relacionados a datas comemorativas e situações especiais podem ser adquiridos sob certas 
      condições.</p>

    <!--##  topico 12 ##-->
    <h3>Criaturas</h3>
    <p>Nomeados como criaturas, esses são os adversários que os personagens enfrentam durante o jogo. </p>
    <p>As criaturas estão divididas em diferentes categorias de raridade, e essa raridade pode influenciar em seus atributos.</p>
    
    <h4>Recompensas de Criaturas</h4>
    <p>A recompensa é concedida após a aniquilação de um monstro, ou seja, quando o HP do monstro é reduzido a zero. Existem 
      dois tipos de recompensas: a recompensa por dano final e a recompensa por alvo</p>

    <!--##  topico 14 ##-->
    <h3>Movimentação dos Personagens</h3>
    <p>A movimentação varia de acordo com cada personagem e pode ocorrer em padrões como círculo, cruz ou X.</p>
    <p>A movimentação refere-se à quantidade de casas que um personagem pode percorrer no tabuleiro.</p>
    
    <h3>Movimentação dos Adversários</h3>
    <p>A movimentação dos adversários é restrita ao alvo selecionado, permitindo apenas movimentos em forma de cruz.</p>

    <!--##  topico 15 ##-->
    <h2>Combate</h2>
    <h4>Atacando</h4>
    <p>O jogador só pode realizar um ataque se estiver usando pelo menos um equipamento com poder de ataque e houver um monstro ao 
      alcance. Se o jogador dispuser de três equipamentos, poderá executar até três ataques distintos.</p>
    <p>As cartas de ataque contêm uma marcação de dados que representa a probabilidade de sucesso do ataque. Ou seja, se o resultado
       do dado for igual ou maior que esse valor, o ataque é bem-sucedido.</p>
    <p>Além disso, alguns itens possuem habilidades que, ao serem ativadas durante um combate, aplicam um efeito ao alvo ou 
      desencadeiam um evento relacionado à habilidade.</p>
    <p>Para que um ataque tenha sucesso, a taxa de acerto deve superar a taxa de defesa do inimigo. Suponhamos que você tenha três 
      equipamentos à sua disposição; isso permite realizar até três ataques. Em cada ataque, você rola dados, variando de um D6 a 
      um D12.</p>
    <p>Cada criatura possui sua própria chance de acerto, denominado por CP. Isso significa que um jogador só causará dano se o 
      resultado do dado for superior da criatura. Além disso, o dano causado é indicado e calculado pelo aplicativo, e a faixa de 
      dano que o equipamento pode infligir está descrita na carta correspondente.</p>

    <h4>Situação Exemplo</h4>
    <p>[escrever...]</p>

    <h4>Defendendo</h4>
    <p>[escrever...]</p>

    <h4>Ideias</h4>
    <p>Ideia: Adiconar eventos que introduzem objetos ao mapa, estes podem ser interagidos tanto com os personagens como os monstros.</p>

</div>
</body>
</html>

