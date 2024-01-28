<?php
header('Access-Control-Allow-Origin: *');
require_once('../config.php');

$id = $_POST['id'];

if(empty($id)){
    echo json_encode(["message" => "Sem ID válido"]);
}else{
    $sql = "SELECT ID, TAG, MODELO, PROBLEMA, DATA_ENVIO, SITUACAO FROM chs_controle WHERE id = '$id'";

    $response = $conn->query($sql);
    $rows = array();

    if($response && $response->num_rows > 0){ 

        while($row = $response->fetch_assoc()){
            $rows[] = $row;
        }
        echo json_encode($rows);
    }else{
        echo json_encode(["message" => "Não possui usuário cadastrado"]);
    }
}
?>
