<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

$tag = $_POST['tag'];
$modelo = $_POST['modelo'];
$problema = $_POST['problema'];
$data_envio = $_POST['data_envio'];
$situacao = $_POST['situacao'];
$previsao = $_POST['previsao'];
$retorno = $_POST['retorno'];
$garantia = $_POST['garantia'];

if (empty($tag) || empty($modelo)) {
    echo "<script>alert('Todos os campos precisam ser preenchidos');</script>";
} else {

    if ($data_envio === 'undefined/undefined/') {
        $data_envio = date('d-m-Y');
    }
    if ($situacao === 'Enviado') {
        // Adiciona 7 dias à data de envio
        $data_previsao = date('d-m-Y', strtotime($data_envio . '+7 days'));
        $data_retorno = ('Pendente');
        $data_garantia = ('Nao');
        $sql = "INSERT INTO heads (tag, modelo, problema, data_envio, situacao, previsao, retorno, garantia) VALUES ('".$tag."', '".$modelo."', '".$problema."', '".$data_envio."', '".$situacao."', '".$data_previsao."', '".$data_retorno."', '".$data_garantia."')";
      } 
      else {
        $data_previsao = ('Pendente');
        $data_retorno = ('Pendente');
        $data_garantia = ('Nao');
        $sql = "INSERT INTO heads (tag, modelo, problema, data_envio, situacao, previsao, retorno, garantia) VALUES ('".$tag."', '".$modelo."', '".$problema."', '".$data_envio."', '".$situacao."', '".$data_previsao."', '".$data_retorno."', '".$data_garantia."')";
      }
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Salvo no banco de dados!');</script>";
        $conn->close();
    } else {
        echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
    }
}
$conn->close();
?>
