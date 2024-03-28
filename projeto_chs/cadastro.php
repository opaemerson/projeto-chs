<?php
header('Access-Control-Allow-Origin: *');
require_once('classes/regras_chs.php');
session_start();

$tag = $_POST['tag'];
$modelo = $_POST['modelo'];
$problema = $_POST['problema'];
$data_envio = $_POST['data_envio'];
$situacao = $_POST['situacao'];
$previsao = $_POST['previsao'];
$retorno = $_POST['retorno'];
$garantia = $_POST['garantia'];
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$id_equip = $_POST['id_equip'];


if (empty($tag) || empty($modelo)) {
    echo "<script>alert('Todos os campos precisam ser preenchidos');</script>";
} else {

    $tagExistente = "SELECT id, manutencao, situacao FROM chs_controle WHERE tag = '$tag'";
    $resultado = $conn->query($tagExistente);

    if ($resultado->num_rows > 0){
        $row = $resultado->fetch_assoc();
        $manutencao = $row["manutencao"];
        $situacao_original = $row["situacao"];
        
        if ($situacao_original === 'Pendente' || $situacao_original === 'Concluido'){ 
            if ($situacao === 'Enviado') {
                $data_envio = date('d-m-Y');
                $data_previsao = date('d-m-Y', strtotime($data_envio . '+7 days'));
                $data_retorno = ('Pendente');
                $data_garantia = ('Nao');
                $manutencao_novo = $manutencao + 1;
                $sql = "UPDATE chs_controle SET modelo = '".$modelo."', problema = '".$problema."', data_envio = '".$data_envio."', situacao = '".$situacao."', previsao = '".$data_previsao."', retorno = '".$data_retorno."', garantia = '".$data_garantia."', manutencao = '".$manutencao_novo."' WHERE tag = '".$tag."'";
              } 
              else {
                $data_envio = ('Pendente');
                $data_previsao = ('Pendente');
                $data_retorno = ('Pendente');
                $data_garantia = ('Nao');
                $sql = "UPDATE chs_controle SET modelo = '".$modelo."', problema = '".$problema."', data_envio = '".$data_envio."', situacao = '".$situacao."', previsao = '".$data_previsao."', retorno = '".$data_retorno."', garantia = '".$data_garantia."' WHERE tag = '".$tag."'";
              }
    
              if ($conn->query($sql) === FALSE) {
                echo "<script>alert('Erro ao inserir no banco de dados!');</script>";
              }

        } else {
            echo "<script>alert('Nao foi possivel inserir dados.');</script>";
        }

        }else{

            try {
                $valida_regra = (new Regras())->limite_cinco($usuario, 'chs_controle');

                if ($valida_regra == FALSE){
                    throw new Exception("Limite excedido " . $conn->error);
                }
                
                $data_envio = date('d-m-Y');
                $data_previsao = date('d-m-Y', strtotime($data_envio . '+7 days'));
                
                if ($situacao === 'Enviado') {
                    $data_retorno = 'Pendente';
                    $data_garantia = 'Nao';
                    $manutencao = 1;
                } else {
                    $data_envio = 'Pendente';
                    $data_retorno = 'Pendente';
                    $data_garantia = 'Nao';
                    $manutencao = 0;
                }
            
                $sql = "INSERT INTO chs_controle (equipamento_id, tag, modelo, problema, data_envio, situacao, previsao, retorno, garantia, manutencao) 
                        VALUES ('$id_equip', '$tag', '$modelo', '$problema', '$data_envio', '$situacao', '$data_previsao', '$data_retorno', '$data_garantia', '$manutencao')";
                
                if ($conn->query($sql) === FALSE) {
                    throw new Exception("Erro ao inserir no controle: " . $conn->error);
                }
            
                $tag_id = $conn->insert_id;
            
                $sql = "INSERT INTO chs_historico (tag_id, usuario_id) VALUES ('$tag_id', '$usuario')";
                
                if ($conn->query($sql) === FALSE) {
                    throw new Exception("Erro ao inserir no histórico: " . $conn->error);
                }
            
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
    }
}
$conn->close();