<?php
header('Access-Control-Allow-Origin: *');
require_once('../config.php');

$procurarModelo = $_POST['procurarModelo'];
$procurarProblema = $_POST['procurarProblema'];
$procurarSituacao = $_POST['procurarSituacao'];

$condicao = '';

if (!empty($procurarModelo)) {
  $condicao .= "modelo LIKE '%$procurarModelo%'";
}

if (!empty($procurarProblema)) {
  if (!empty($condicao)) {
    $condicao .= " AND ";
  }
  $condicao .= "problema LIKE '%$procurarProblema%'";
}

if (!empty($procurarSituacao)) {
  if (!empty($condicao)) {
    $condicao .= " AND ";
  }
  $condicao .= "situacao LIKE '%$procurarSituacao%'";
}

if (empty($condicao)) {
  $echo = "Nenhum critério de pesquisa especificado.";
} else {
  $sql = "SELECT a.*,
  (SELECT u.nome FROM chs_historico h INNER JOIN usuarios u ON u.id = h.usuario_id WHERE h.tag_id = a.id order by h.id DESC limit 1) as usuario
   FROM chs_controle a WHERE $condicao";

  $response = $conn->query($sql);

  if($response && $response->num_rows > 0){ 

      while($row = $response->fetch_assoc()){
          $rows[] = $row;
      }
      echo json_encode($rows);
  }else{
      echo json_encode(["message" => "Não possui marca cadastrada"]);
  }
}