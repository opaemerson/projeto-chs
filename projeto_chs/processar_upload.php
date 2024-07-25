<?php
header('Access-Control-Allow-Origin: *');
require_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["arquivo"]["name"]);
    $csvFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    try{

        if ($csvFileType != "csv") {
            throw new Exception('Formato nao permitido');
        }

        if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $targetFile)) {
            $file = fopen($targetFile, "r");
            while (($line = fgetcsv($file)) !== FALSE) {
                $valor = explode(";", $line[0]);
    
                $tag = $valor[0];
                $equipamento = $valor[1];
                $modelo = $valor[2];
                $problema = $valor[3];
                $situacao = $valor[4];
    
                $tagExistente = "SELECT id, data_envio, manutencao 
                FROM chs_controle WHERE tag = '$tag'";
                $resultado = $conn->query($tagExistente);
    
                if ($resultado->num_rows > 0){
                    
                    $row = $resultado->fetch_assoc();
    
                    if ($situacao == 'Concluido'){
                        $data_envio = $row["data_envio"];
                        $data_previsao = 'Concluido';
                        $data_retorno = date('d-m-Y');
                        $diferenca_dias = strtotime($data_retorno) - strtotime($data_envio);
                        $diferenca_dias = floor($diferenca_dias / (60 * 60 * 24));
                        $garantia = ($diferenca_dias > 30) ? 'Nao' : 'Sim';
                        $updateQuery = "UPDATE chs_controle SET modelo = '$modelo', problema = '$problema', situacao = '$situacao', previsao = '$data_previsao', retorno = '$data_retorno', garantia = '$garantia' WHERE tag = '$tag'";
                        $conn->query($updateQuery);
                        }
    
                    if ($situacao == 'Enviado'){
                        $data_envio = date('d-m-Y');
                        $data_previsao = date('d-m-Y', strtotime($data_envio . '+7 days'));
                        $data_retorno = ('Pendente');
                        $data_garantia = ('Nao');
                        $manutencao = $row["manutencao"];
                        $manutencao_novo = $manutencao + 1;
                        $updateQuery = "UPDATE chs_controle SET modelo = '".$modelo."', problema = '".$problema."', data_envio = '".$data_envio."', situacao = '".$situacao."', previsao = '".$data_previsao."', retorno = '".$data_retorno."', garantia = '".$data_garantia."', manutencao = '".$manutencao_novo."' WHERE tag = '".$tag."'";
                        $conn->query($updateQuery);
                    }
    
                    }else{
    
                        if (stripos($tag, 'TAG') !== false) {
                            continue;
                        }
    
                        if (empty($tag)){
                            continue;
                        }
    
                        if ($situacao == 'Enviado'){
                            $data_envio = date('d-m-Y');
                            $data_previsao = date('d-m-Y', strtotime($data_envio . '+7 days'));
                            $data_retorno = ('Pendente');
                            $garantia = ('Nao');
                            $manutencao = 1;
                        } 
                        
                        if($situacao == 'Pendente'){
                            $data_envio = 'Nao obteve Envio';
                            $data_previsao = '';
                            $data_retorno = '';
                            $garantia = '';
                        } 
    
                        if ($situacao == 'Concluido'){
                            $data_envio = 'Nao obteve Envio';
                            $data_previsao = 'Concluido';
                            $data_retorno = date('d-m-Y');
                            $diferenca_dias = strtotime($data_retorno) - strtotime($data_envio);
                            $diferenca_dias = floor($diferenca_dias / (60 * 60 * 24));
                            $garantia = ($diferenca_dias > 30) ? 'Nao' : 'Sim';
                        }
    
                        $sql = "INSERT INTO chs_controle (tag, modelo, problema, situacao, data_envio, previsao, retorno, garantia, manutencao) VALUES ('$tag', '$modelo', '$problema', '$situacao', '$data_envio' , '$data_previsao' , '$data_retorno', '$garantia', '$manutencao')";
                        $conn->query($sql) === TRUE;
                        }
                    }
                        fclose($file);
                        header("Location: index.php");
                        echo "Arquivo enviado e dados inseridos com sucesso.";
                        exit();
        }

    }
    catch (Exception $e) {
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    }
}

?>