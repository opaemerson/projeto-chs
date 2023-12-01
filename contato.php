<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/cabecalho.css">
    <link rel="stylesheet" href="css/template1.css">
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
        <div class="logo"><h3 style="color: #00ff00;">GOB INC</h3></div>
            <div class="menu">
                <nav>
                    <a href="index.php">PROJETOS</a>
                    <a href="contato.php">CONTATO</a>
                    <a href="login.php">ENTRAR</a>
                    <?php
                    if (isset($_SESSION['nome'])) {
                    echo '<a href="sair.php">SAIR</a>';
                    }
                    ?>
                </nav>
            </div>


        </div>
    </header>

    <section id="home">
        <div class="container1">
            <h2>CHS</h2>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum culpa et ad, itaque ipsum impedit ducimus vero fugit amet earum deserunt omnis possimus minima ipsam quia est quaerat illo quidem.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem, repudiandae corporis possimus veritatis fugiat facilis nihil sapiente facere delectus ex vel voluptatibus cumque recusandae quaerat dignissimos. Illum, exercitationem recusandae? Cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus molestias sapiente qui odio aspernatur vitae dolores ab optio accusamus sint pariatur, maxime facere ullam eveniet, reiciendis dolore quia rerum architecto.</p>
            <button type="button" onclick="verificarLogin()">Acessar</button>
        </div>
    </section>

    <section id="sobre">
        <div class="container1">
            <h2>Ganolia</h2>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum culpa et ad, itaque ipsum impedit ducimus vero fugit amet earum deserunt omnis possimus minima ipsam quia est quaerat illo quidem.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Autem, repudiandae corporis possimus veritatis fugiat facilis nihil sapiente facere delectus ex vel voluptatibus cumque recusandae quaerat dignissimos. Illum, exercitationem recusandae? Cum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus molestias sapiente qui odio aspernatur vitae dolores ab optio accusamus sint pariatur, maxime facere ullam eveniet, reiciendis dolore quia rerum architecto.</p>
            <button type="button" onclick="verificarLoginMecanismo()">Acessar</button>
        </div>
    </section>

<?php
    if (isset($_SESSION['nome'])) {
        echo '<ul class="navbar-nav ml-auto">';
        echo '<li class="nav-item">';
        echo '<p class="text-light">Bem-Vindo, ' . $_SESSION['nome'] . ' | Permissao: ' . $_SESSION['permissao'] . ' | ID: ' . $_SESSION['id'] . '</p>';
        echo '</li>';
        echo '<li class="nav-item">';
        echo '</li>';
        echo '</ul>';
    }
?>

                    

<script>
        var usuarioLogado = <?php echo isset($_SESSION['nome']) ? 'true' : 'false'; ?>;
        var permissaoUsuario = <?php echo isset($_SESSION['permissao']) ? 'true' : 'false'; ?>;
</script>
<script src="./scripts/verificacoes.js"></script>
</body>
</html>
