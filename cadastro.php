<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');
session_start();

$tag = $_POST['tag'];
$modelo = $_POST['modelo'];
$problema = $_POST['problema'];
$data_envio = $_POST['data_envio'];
$situacao = $_POST['situacao'];
$previsao = $_POST['previsao'];
$retorno = $_POST['retorno'];
$garantia = $_POST['garantia'];
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';


if (empty($tag) || empty($modelo)) {
    echo "<script>alert('Todos os campos precisam ser preenchidos');</script>";
} else {

    $tagExistente = "SELECT id, manutencao, situacao FROM heads WHERE tag = '$tag'";
    $resultado = $conn->query($tagExistente);

    if ($resultado->num_rows > 0){

        $row = $resultado->fetch_assoc();
        $manutencao = $row["manutencao"];
        $situacao_original = $row["situacao"];
        
        if ($situacao_original === 'Pendente' || $situacao_original === 'Concluido'){ 
            if ($situacao === 'Enviado') {
                $data_envio = date('d-m-Y');
                $data_previsao = date('d-m-Y', strtotime($data_envio . '+7 days'));
                $data_retorno = ('Pendente');
                $data_garantia = ('Nao');
                $manutencao_novo = $manutencao + 1;
                $sql = "UPDATE heads SET modelo = '".$modelo."', problema = '".$problema."', data_envio = '".$data_envio."', situacao = '".$situacao."', previsao = '".$data_previsao."', retorno = '".$data_retorno."', garantia = '".$data_garantia."', manutencao = '".$manutencao_novo."' WHERE tag = '".$tag."'";
              } 
              else {
                $data_envio = ('Pendente');
                $data_previsao = ('Pendente');
                $data_retorno = ('Pendente');
                $data_garantia = ('Nao');
                $sql = "UPDATE heads SET modelo = '".$modelo."', problema = '".$problema."', data_envio = '".$data_envio."', situacao = '".$situacao."', previsao = '".$data_previsao."', retorno = '".$data_retorno."', garantia = '".$data_garantia."' WHERE tag = '".$tag."'";
              }
    
              if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Salvo no banco de dados!');</script>";
                $conn->close();
            } else {
                echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
            }
        } else {
            echo "<script>alert('Não foi possível inserir dados.');</script>";
        }

        }else{
            $data_envio = date('d-m-Y');

            if ($situacao === 'Enviado') {
                $data_previsao = date('d-m-Y', strtotime($data_envio . '+7 days'));
                $data_retorno = ('Pendente');
                $data_garantia = ('Nao');
                $manutencao = 1;
                $sql = "INSERT INTO heads (tag, modelo, problema, data_envio, situacao, previsao, retorno, garantia, manutencao) VALUES ('".$tag."', '".$modelo."', '".$problema."', '".$data_envio."', '".$situacao."', '".$data_previsao."', '".$data_retorno."', '".$data_garantia."', '".$manutencao."')";
              } 
              else {
                $data_envio = ('Pendente');
                $data_previsao = ('Pendente');
                $data_retorno = ('Pendente');
                $data_garantia = ('Nao');
                $sql = "INSERT INTO heads (tag, modelo, problema, data_envio, situacao, previsao, retorno, garantia) VALUES ('".$tag."', '".$modelo."', '".$problema."', '".$data_envio."', '".$situacao."', '".$data_previsao."', '".$data_retorno."', '".$data_garantia."')";
              }
    
              if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Salvo no banco de dados!');</script>";
            } else {
                echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
            }

            $consulta_id = "SELECT id FROM heads WHERE tag = '$tag'";
            $resultado_consulta = $conn->query($consulta_id);
            if ($resultado_consulta->num_rows > 0){

                $row_resultado = $resultado_consulta->fetch_assoc();
                $id = $row_resultado['id'];

                $sql_dois = "INSERT INTO historico (tag_id, usuario_id) VALUES ('".$id."', '".$usuario."')";

            if ($conn->query($sql_dois) === TRUE){
                echo "<script>alert('Salvo no banco de dados!');</script>";
            }else {
                echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
            }
        }
    }
}
$conn->close();