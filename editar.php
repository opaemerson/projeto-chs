<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

$id = $_POST['id'];
$tag = $_POST['tag'];
$modelo = $_POST['modelo'];
$problema = $_POST['problema'];
$data_envio = $_POST['data_envio'];
$situacao = $_POST['situacao'];
$previsao = $_POST['previsao'];
$retorno = $_POST['retorno'];
$garantia = $_POST['garantia'];

if (empty($id)) {
  echo json_encode(["message" => "Sem ID válido"]);
} else {
  // Verifica se a variável $data_envio é undefined
  if ($data_envio === 'undefined/undefined/') {
    $data_envio = date('d-m-Y'); // Obtém a data atual no formato "dd-mm-yyyy"
  } 

  if ($situacao === 'Enviado') {
    $data_envio = date('d-m-Y');
    $data_previsao = date('d-m-Y', strtotime($data_envio . ' +7 days'));
    $data_retorno = ('Pendente');
    $data_garantia = ('Nao');
    
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