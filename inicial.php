<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto C.E.E</title>
</head>
<body>
    <h1>Projeto C.E.E</h1>
    <p><b>Objetivo:</b> fazer fkjsadogfh hgiuf fgjhdiu hfireu kpf.</p>

    <script>
        var usuarioLogado = false; 

        function verificarLogin() {
            if (!usuarioLogado) {
                window.location.href = 'login.php';
            } else {
                window.location.href = 'index.php';
            }
        }
    </script>

    <button type="button" onclick="verificarLogin()">Acessar</button>
</body>
</html>
