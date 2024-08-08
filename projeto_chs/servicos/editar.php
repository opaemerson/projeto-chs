<?php
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');

$tag = $_POST['editTag'];
$modelo = $_POST['editModelo'];
$problema = $_POST['editProblema'];
$idEquip = $_POST['editEquipamento'];
$situacao = $_POST['editSituacao'];

$config = new Config();

if($situacao == 'Pendente'){
      $data_envio = 'Pendente';
      $data_previsao = 'Pendente';
      $data_retorno = 'Pendente';
      $data_garantia = 'Nao';

      $sql = "UPDATE chs_controle SET 
      modelo = ?, 
      problema = ?, 
      data_envio = ?,
      situacao = ?, 
      previsao = ?, 
      retorno = ?, 
      garantia = ?,
      equipamento_id = ?
      WHERE tag = ?";

      $stmt = $config->conn->prepare($sql);
      $stmt->bind_param("ssssssssi", $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $data_garantia, $idEquip, $tag);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
    $stmt->close();
    header("Location: http://localhost/portfolio/projeto_chs/");
    exit();      
    } else {
    $stmt->close();
    header("Location: http://localhost/portfolio/projeto_chs/");
    exit();
  }
} else {
  //fazer um select no controle, fazer o ternario para substituir o do post ou manter.
  $sql = "UPDATE chs_controle SET 
      modelo = ?, 
      problema = ?,      
      equipamento_id = ?
      WHERE tag = ?";

      $stmt = $config->conn->prepare($sql);
      $stmt->bind_param("sssi", $modelo, $problema, $idEquip, $tag);

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
    $stmt->close();
    header("Location: http://localhost/portfolio/projeto_chs/");
    exit();      
    } else {
    $stmt->close();
    header("Location: http://localhost/portfolio/projeto_chs/");
    exit();
  }
}
?>