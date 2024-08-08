<?php
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');

$tag = $_POST['editTag'];
$modelo = $_POST['editModelo'];
$problema = $_POST['editProblema'];
$idEquip = $_POST['editEquipamento'];
$situacao = $_POST['editSituacao'];
$data_envio = date('d-m-Y');
$data_previsao = date('d-m-Y', strtotime($data_envio . ' +7 days'));
$data_retorno = 'Pendente';
$data_garantia = 'Nao';

$config = new Config();

  $queryEnviadoExiste = "SELECT situacao, manutencao FROM chs_controle WHERE tag = '$tag'";
  $consultaEnviadoExiste = $config->conn->query($queryEnviadoExiste);
  $rowEnviado = $consultaEnviadoExiste->fetch_assoc();
  $situacaoAtual = $rowEnviado['situacao'];
  $manutencao = $rowEnviado['manutencao'];

  switch($situacaoAtual){
    case 'Pendente':
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
      break;

    case 'Enviado':
        $manutencao_novo = $manutencao + 1;

        $sql = "UPDATE chs_controle SET 
        modelo = ?, 
        problema = ?, 
        data_envio = ?, 
        situacao = ?, 
        previsao = ?, 
        retorno = ?, 
        garantia = ?,
        manutencao = ?,
        equipamento_id = ?
        WHERE tag = ?";

        $stmt = $config->conn->prepare($sql);
        $stmt->bind_param("sssssssssi", $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $data_garantia, $manutencao_novo, $idEquip, $tag);
      break;

    case 'Concluido':
        $data_previsao = 'Concluido';
        $data_retorno = date('Y-m-d'); 
        
        $diferenca_dias = strtotime($data_retorno) - strtotime($data_envio);
        $diferenca_dias = floor($diferenca_dias / (60 * 60 * 24));
        $garantia = ($diferenca_dias > 30) ? 'Nao' : 'Sim';
    
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
        $stmt->bind_param("ssssssssi", $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $garantia, $idEquip, $tag);

      break;
  }
  
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
  
?>