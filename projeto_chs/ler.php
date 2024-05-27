<?php
header('Access-Control-Allow-Origin: *');
require_once('../config.php');

$id = $_POST['id'];

if(empty($id)){
    echo json_encode(["message" => "Sem ID válido"]);
}else{
    $sql = "SELECT A.ID, 
                A.TAG, 
                A.MODELO, 
                A.PROBLEMA, 
                A.DATA_ENVIO,
                A.SITUACAO, 
                B.NOME as EQUIPAMENTO
            FROM 
                chs_controle A
            LEFT JOIN 
                chs_equipamento B
            ON 
                B.id = A.equipamento_id
            WHERE 
                A.id = '$id'";

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
