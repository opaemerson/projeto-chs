<?php
header('Access-Control-Allow-Origin: *');
require_once('config.php');

$procurarModelo = $_POST['procurarModelo'];

if (empty($procurarModelo)) {
    echo json_encode(["message" => "Não encontrado!"]);
  } else {
    $sql = "SELECT * FROM heads WHERE modelo LIKE '%$procurarModelo%'";
    
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
  
  $conn->close();
?>