<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/portfolio/styles.css">
    <link rel="stylesheet" href="css/chs/cabecalho.css">
    <link rel="stylesheet" href="css/portfolio/template1.css">
    <link rel="stylesheet" href="css/portfolio/caroussel.css">
    <title>Projeto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Dosis:wght@500&family=Oswald:wght@300&family=Playfair+Display:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body {font-family: "Lato", sans-serif}
    .mySlides {display: none}
    </style>
</head>

<body>
<?php
    session_start();
    ?>
    <header>
        <div class="container">
        <div class="logo"><h3 style="color: #00ff00;">Portfólio</h3></div>
            <div class="menu">
                <nav>
                    <a href="index.php">PROJETOS</a>
                    <a href="portfolio/contato.php">SOBRE</a>

                    <?php
                    if (isset($_SESSION['nome'])) {
                    echo '<a href="portfolio/sair.php">SAIR</a>';
                    } else{
                    echo '<a href="portfolio/login.php">ENTRAR</a>';
                    }
                    ?>
                </nav>
            </div>

            <div class="social">
                    <?php
                    if (isset($_SESSION['nome'])) {
                    echo '<p style="color: #00ff00;">' . $_SESSION['nome'] . ' | Permissao: ' . $_SESSION['permissao'] . 
                    ' | ID: ' . $_SESSION['id'] . '</p>';
                    }
                    ?>
            </div>
        </div>
    </header>
<br><br>
<div class="carousel">
<div class="slide">
<img class="carousel-img" src="./Images/portfolio/chs.jpg">
<br>
<p><b>Projeto:</b> Control Handling Sytem - CHS</p>
<br><br>
<button type="button" class="botao-carousel" onclick="verificarLogin('chs')">Acessar</button>
</div>
            
</div> 
<button class="prev" onclick="plusSlides(-1)">Anterior</button>
<button class="next" onclick="plusSlides(1)">Próximo</button>  


<script>
        var usuarioLogado = <?php echo isset($_SESSION['nome']) ? 'true' : 'false'; ?>;
        var permissaoUsuario = <?php echo isset($_SESSION['permissao']) ? 'true' : 'false'; ?>;
</script>
<script src="./portfolio/scripts/verificacoes.js"></script>
<script src="./portfolio/scripts/caroussel.js"></script>
</body>
</html>
