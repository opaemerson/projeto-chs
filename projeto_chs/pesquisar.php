<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

$procurarPalavra = $_POST['procurarPalavra'];

if (empty($procurarPalavra)) {
    echo json_encode(["message" => "Não encontrado!"]);
  } else {
    $sql = "SELECT a.*,
    (SELECT u.nome FROM historico h INNER JOIN usuarios u ON u.id = h.usuario_id WHERE h.tag_id = a.id order by h.id DESC limit 1) as usuario
     FROM heads a WHERE tag LIKE '%$procurarPalavra%'";
    
    $response = $conn->query($sql);
  
    if($response && $response->num_rows > 0){ 

        while($row = $response->fetch_assoc()){
            $rows[] = $row;
        }
        echo json_encode($rows);
    }else{
        echo json_encode(["message" => "Não possui usuário cadastrado"]);
    }
  }
  
  $conn->close();
?>