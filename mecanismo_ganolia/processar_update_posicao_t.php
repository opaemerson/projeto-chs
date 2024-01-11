<?php
include('../protecao.php');
require_once('../config.php');

$personagemId = $_SESSION['personagem_ganolia'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newRow = $_POST['newRow'];
    $newCol = $_POST['newCol'];

    //verificando territorio atual para criar raizes de teleport
    $consulta = "SELECT gs.territorio_id as terr 
    FROM ganolia_sessao gs
    WHERE gs.personagem_id = $personagemId";
    $result = $conn->query($consulta);

    if ($conn->query($consulta) === FALSE) {
        echo json_encode(array("success" => false, "message" => "ERRO AO BUSCAR POSICAO: " . $conn->error));
    }

    $linha = $result->fetch_assoc();

    if($linha['terr'] == 1){
        if($newRow == 4 && $newCol == 5){
            $newTerritorio = 2;
    
            $sql = "UPDATE ganolia_sessao gs 
            SET gs.territorio_id = $newTerritorio
            WHERE personagem_id = $personagemId";
        
            $resultado = $conn->query($sql);
        
            if ($conn->query($sql) === TRUE) {
                // Resposta de sucesso
                echo json_encode(array("success" => true, "message" => "Posição atualizada com sucesso"));
            } else {
                // Resposta de erro
                echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
            }
        
            // Fecha a conexão
            $conn->close();
        }
    }

    else if($linha['terr'] == 2){
        if($newRow == 2 && $newCol == 2){
            $newTerritorio = 1;
    
            $sql = "UPDATE ganolia_sessao gs 
            SET gs.territorio_id = $newTerritorio
            WHERE personagem_id = $personagemId";
        
            $resultado = $conn->query($sql);
        
            if ($conn->query($sql) === TRUE) {
                // Resposta de sucesso
                echo json_encode(array("success" => true, "message" => "Posição atualizada com sucesso"));
            } else {
                // Resposta de erro
                echo json_encode(array("success" => false, "message" => "Erro ao atualizar a posição: " . $conn->error));
            }
        
            // Fecha a conexão
            $conn->close();
        }
    }



} else {
    echo json_encode(array("success" => false, "message" => "Método de requisição inválido"));
}
?>




