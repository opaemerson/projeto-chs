<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

$id = $_POST['id'];
$tag = $_POST['tag'];
$modelo = $_POST['modelo'];
$problema = $_POST['problema'];
$data_envio = $_POST['data_envio'];
$situacao = $_POST['situacao'];


if (empty($id)) {
  echo json_encode(["message" => "Sem ID válido"]);
} else {

  if ($data_envio === 'undefined/undefined/') {
    $data_envio = date('d-m-Y');
  } 

  if ($situacao === 'Enviado') {
    $data_envio = date('d-m-Y');
    $data_previsao = date('d-m-Y', strtotime($data_envio . ' +7 days'));
    $data_retorno = ('Pendente');
    $data_garantia = ('Nao');
    $manutencaoExistente = "SELECT manutencao FROM heads WHERE tag = '$tag'";
    $resultadoExistente = $conn->query($manutencaoExistente);
    $row = $resultadoExistente->fetch_assoc();
    $manutencao = $row["manutencao"];
    $manutencao_novo = $manutencao + 1;
    
    $sql = "UPDATE heads SET 
    tag = '".$tag."', 
    modelo = '".$modelo."', 
    problema = '".$problema."', 
    data_envio = '".$data_envio."', 
    situacao = '".$situacao."', 
    previsao = '".$data_previsao."', 
    retorno = '".$data_retorno."', 
    garantia = '".$data_garantia."',
    manutencao = '".$manutencao_novo."'
    WHERE id = ".$id;
  }

  else if ($situacao === 'Concluido'){
    $data_previsao = ('Concluido');
    $data_retorno = date('d-m-Y');
    $data_envio = $_POST['data_envio'];

    if($data_envio == 'Pendente'){
      $data_envio = 'Nao obteve Envio';
    }
    
    //Calcula a diferença em dias entre a data de envio e a data de retorno
    $diferenca_dias = strtotime($data_retorno) - strtotime($data_envio);
    $diferenca_dias = floor($diferenca_dias / (60 * 60 * 24)); // converte para dias
    $garantia = ($diferenca_dias > 30) ? 'Nao' : 'Sim';


    $sql = "UPDATE heads SET 
    tag = '".$tag."', 
    modelo = '".$modelo."', 
    problema = '".$problema."', 
    data_envio = '".$data_envio."', 
    situacao = '".$situacao."', 
    previsao = '".$data_previsao."', 
    retorno = '".$data_retorno."', 
    garantia = '".$garantia."'
    WHERE id = ".$id;

  } 
  else {
    $data_previsao = ('Pendente');
    $data_retorno = ('Pendente');
    $data_garantia = ('Nao');
    $data_envio = ('Pendente');
    $sql = "UPDATE heads SET 
    tag = '".$tag."', 
    modelo = '".$modelo."', 
    problema = '".$problema."', 
    data_envio = '".$data_envio."', 
    situacao = '".$situacao."', 
    previsao = '".$data_previsao."', 
    retorno = '".$data_retorno."', 
    garantia = '".$data_garantia."'
    WHERE id = ".$id;
  }

  $response = $conn->query($sql);

  if ($response === TRUE) {
    echo json_encode(["message" => "Usuário editado com sucesso"]);
  } else {
    echo json_encode(["message" => "Erro ao editar o usuário"]);
  }
}

$conn->close();



?>