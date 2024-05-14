<?php
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');

$id = $_POST['id'];
$tag = $_POST['tag'];
$modelo = $_POST['modelo'];
$problema = $_POST['problema'];
$data_envio = $_POST['data_envio'];
$situacao = $_POST['situacao'];


if (empty($id)) {
  echo json_encode(["message" => "Sem ID valido"]);
} else {

  if ($data_envio === 'undefined/undefined/') {
    $data_envio = date('d-m-Y');
  }
  
  $queryEnviadoExiste = "SELECT situacao, manutencao FROM chs_controle WHERE tag = '$tag'";
  $consultaEnviadoExiste = $conn->query($queryEnviadoExiste);
  $rowEnviado = $consultaEnviadoExiste->fetch_assoc();
  $situacaoAtual = $rowEnviado['situacao'];
  $data_envio = date('d-m-Y');
  $data_previsao = date('d-m-Y', strtotime($data_envio . ' +7 days'));
  $data_retorno = 'Pendente';
  $data_garantia = 'Nao';
  $manutencao = $rowEnviado['manutencao'];
  
  // Preparando a consulta SQL com base na situa��o atual
  if ($situacaoAtual === 'Enviado') { 
      $sql = "UPDATE chs_controle SET 
      tag = ?, 
      modelo = ?, 
      problema = ?, 
      data_envio = ?, 
      situacao = ?, 
      previsao = ?, 
      retorno = ?, 
      garantia = ?
      WHERE id = ?";
  } else {
      
      $manutencao_novo = $manutencao + 1;
  
      $sql = "UPDATE chs_controle SET 
      tag = ?, 
      modelo = ?, 
      problema = ?, 
      data_envio = ?, 
      situacao = ?, 
      previsao = ?, 
      retorno = ?, 
      garantia = ?,
      manutencao = ?
      WHERE id = ?";
  }
  
  if ($situacao === 'Concluido') {
    $data_previsao = 'Concluido';
    $data_retorno = date('Y-m-d'); 
    $data_envio = $_POST['data_envio'];

    if ($data_envio == 'Pendente') {
        $data_envio = 'Nao obteve Envio';
    }
    
    $diferenca_dias = strtotime($data_retorno) - strtotime($data_envio);
    $diferenca_dias = floor($diferenca_dias / (60 * 60 * 24));
    $garantia = ($diferenca_dias > 30) ? 'Nao' : 'Sim';

    $sql = "UPDATE chs_controle SET 
        tag = ?, 
        modelo = ?, 
        problema = ?, 
        data_envio = ?, 
        situacao = ?, 
        previsao = ?, 
        retorno = ?, 
        garantia = ?
        WHERE id = ?";
  }
  
  $stmt = $conn->prepare($sql);
  
  if (!$stmt) {
      throw new Exception("Erro ao preparar a consulta para atualiza��o no controle: " . $conn->error);
  }
  
  if ($situacaoAtual === 'Enviado') {
      $stmt->bind_param("ssssssssi", $tag, $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $data_garantia, $id);
  } else {
      $stmt->bind_param("sssssssssi", $tag, $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $data_garantia, $manutencao_novo, $id);
  }
  
  if ($situacao === 'Concluido') {
    $stmt->bind_param("ssssssssi", $tag, $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $garantia, $id);
  }
  
  $stmt->execute();
  
  if ($stmt->affected_rows > 0) {
      echo json_encode(["message" => "Dado editado com sucesso"]);
  } else {
      echo json_encode(["message" => "Erro ao editar o dado"]);
  }
  
  $stmt->close();
}
?>