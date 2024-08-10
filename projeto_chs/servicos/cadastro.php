<?php
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');
require_once('../classes/servicoPrincipal.php');
session_start();

$servico = new Servico();
$config = new Config();

$tag = $_POST['tag'];
$modelo = $_POST['modelo'];
$problema = $_POST['problema'];
$data_envio = date('Y-m-d');
$situacao = $_POST['situacao'];
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$id_equip = $_POST['id_equip'];

$resultado = $servico->buscaGenerica('a.id, a.manutencao, a.situacao', 'chs_controle a', 'a.tag = ' . $tag);

if ($resultado !== false){
    $manutencao = $resultado['manutencao'];
    $situacao_original = $resultado['situacao'];
    
    if ($situacao_original === 'Pendente' || $situacao_original === 'Concluido'){ 
        $data_envio = ('Pendente');
        $data_previsao = ('Pendente');
        $data_retorno = ('Pendente');
        $data_garantia = ('Nao');
        $sql = "UPDATE chs_controle SET modelo = ?, problema = ?, data_envio = ?, situacao = ?, previsao = ?, retorno = ?, garantia = ?, manutencao = ? WHERE tag = ?";
        
        if ($situacao === 'Enviado') {
            $data_envio = date('d-m-Y');
            $data_previsao = date('d-m-Y', strtotime($data_envio . '+10 days'));
            $data_retorno = ('Pendente');
            $data_garantia = ('Nao');
            $manutencao_novo = $manutencao + 1;
            $sql = "UPDATE chs_controle SET modelo = ?, problema = ?, data_envio = ?, situacao = ?, previsao = ?, retorno = ?, garantia = ?, manutencao = ? WHERE tag = ?";
        }

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Erro ao preparar a consulta para atualizacaoo no controle: " . $conn->error);
        }
        
        $stmt->bind_param("ssssssssi", $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $data_garantia, $manutencao_novo, $tag);
        
        if (!$stmt->execute()) {
            throw new Exception("Erro ao atualizar no controle: " . $stmt->error);
        }

    }

}else{

    try {
        $valida_regra = $servico->limiteCinco($usuario, 'chs_controle');

        if ($valida_regra == false){
            throw new Exception("Limite excedido de registros");
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

        $sql_controle = "INSERT INTO chs_controle (equipamento_id, tag, modelo, problema, data_envio, situacao, previsao, retorno, garantia, manutencao) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt_controle = $config->conn->prepare($sql_controle);

        if (!$stmt_controle) {
            throw new Exception("Erro ao preparar a consulta para inserir no controle: " . $config->conn->error);
        }

        $stmt_controle->bind_param("isssssssss", $id_equip, $tag, $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $data_garantia, $manutencao);
        if (!$stmt_controle->execute()) {
            throw new Exception("Erro ao inserir no controle: " . $stmt_controle->error);
        }

        $tag_id = $stmt_controle->insert_id;
        $sql_historico = "INSERT INTO chs_historico (tag_id, usuario_id) VALUES (?, ?)";
        
        $stmt_historico = $config->conn->prepare($sql_historico);

        if (!$stmt_historico) {
            throw new Exception("Erro ao preparar a consulta para insercao no historico: " . $config->conn->error);
        }
        $stmt_historico->bind_param("ii", $tag_id, $usuario);
        
        if (!$stmt_historico->execute()) {
            throw new Exception("Erro ao inserir no historico");
        }

        header("Location: http://localhost/portfolio/projeto_chs/");
    
    } catch (Exception $e) {
        echo "<script type='text/javascript'>
                alert('{$e->getMessage()}');
                window.location.href = 'http://localhost/portfolio/projeto_chs/';
              </script>";
        exit;
    }
    
}