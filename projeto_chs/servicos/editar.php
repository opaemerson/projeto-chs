<?php
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');
require_once('../classes/servicoPrincipal.php');

$servico = new Servico();
$config = new Config();
$tag = $_POST['editTag'];
$queryRegistros = $servico->buscaGenerica('a.data_envio, a.tag, a.modelo, a.problema, a.equipamento_id as equipamento, a.manutencao', 'chs_controle a', 'a.tag = ' . $tag);

$modelo = !empty($_POST['editModelo']) ? $_POST['editModelo'] : $queryRegistros[0]['modelo'];
$problema = !empty($_POST['editProblema']) ? $_POST['editProblema'] : $queryRegistros[0]['problema'];
$equipamento_id = !empty($_POST['editEquipamento']) ? $_POST['editEquipamento'] : $queryRegistros[0]['equipamento'];
$situacao = !empty($_POST['editSituacao']) ? $_POST['editSituacao'] : null;
$manutencao = !empty($queryRegistros[0]['manutencao']) ? $queryRegistros[0]['manutencao'] : 0; 

switch ($situacao){
  case 'Pendente':
    $data_envio = 'Pendente';
    $data_previsao = 'Pendente';
    $data_retorno = 'Pendente';
    $data_garantia = 'Pendente';
    break;
    
  case 'Enviado':
    $manutencao = $manutencao + 1;
    $data_envio = date('d/m/Y');
    $data_previsao = date('d/m/Y', strtotime('+10 days'));
    $data_retorno = 'Pendente';
    $data_garantia = 'Pendente';
    break;
  
  case 'Concluido':
    $data_envio = $queryRegistros[0]['data_envio'];
    $data_previsao = 'Concluido';
    $data_retorno = date('d/m/Y');
    $data_garantia = date('d/m/Y', strtotime('+30 days'));
    break;
  
  default:
    header("Location: http://localhost/portfolio/projeto_chs/");
    break;
}

    $sql = "UPDATE chs_controle SET 
      modelo = ?, 
      problema = ?, 
      data_envio = ?,
      situacao = ?, 
      previsao = ?, 
      retorno = ?, 
      garantia = ?,
      equipamento_id = ?,
      manutencao = ?
      WHERE tag = ?";

    $parametros = [
        $modelo, 
        $problema, 
        $data_envio, 
        $situacao, 
        $data_previsao, 
        $data_retorno, 
        $data_garantia, 
        $equipamento_id,
        $manutencao, 
        $tag
      ];

    $update = $config->updateBd($sql, $parametros);

    header("Location: http://localhost/portfolio/projeto_chs/");
?>