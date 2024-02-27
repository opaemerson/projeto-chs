<?php
include('../protecao.php');
require_once('../config.php');
header('Access-Control-Allow-Origin: *');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["acao"]) && $_POST["acao"] === "limpar") {
        $verificaLog = "SELECT * FROM ganolia_historico";
        $resultado = $conn->query($verificaLog);

        if ($resultado === FALSE){
            echo "<script>alert('Nao existe nenhum historico');</script>";
            echo "<script>window.location.href = 'adm_index.php';</script>";
        } 
        else{
            $excluir = "DELETE FROM ganolia_historico WHERE evento <> 'Registrado'";
            $resultadoExcluir = $conn->query($excluir);
            if($resultadoExcluir === FALSE){
                echo "<script>alert('Falha ao excluir historico');</script>";
                echo "<script>window.location.href = 'adm_index.php';</script>";
            } else{
                echo "<script>alert('Historico limpado!');</script>";
                echo "<script>window.location.href = 'adm_index.php';</script>";
            }
        }
    }
}
?>
</body>