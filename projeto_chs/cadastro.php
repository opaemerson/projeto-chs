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
            $data_envio = ('Pendente');
            $data_previsao = ('Pendente');
            $data_retorno = ('Pendente');
            $data_garantia = ('Nao');
            $sql = "UPDATE chs_controle SET modelo = ?, problema = ?, data_envio = ?, situacao = ?, previsao = ?, retorno = ?, garantia = ?, manutencao = ? WHERE tag = ?";
            
            if ($situacao === 'Enviado') {
                $data_envio = date('d-m-Y');
                $data_previsao = date('d-m-Y', strtotime($data_envio . '+7 days'));
                $data_retorno = ('Pendente');
                $data_garantia = ('Nao');
                $manutencao_novo = $manutencao + 1;
                $sql = "UPDATE chs_controle SET modelo = ?, problema = ?, data_envio = ?, situacao = ?, previsao = ?, retorno = ?, garantia = ?, manutencao = ? WHERE tag = ?";
            }

            $stmt = $conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Erro ao preparar a consulta para atualização no controle: " . $conn->error);
            }
            
            $stmt->bind_param("ssssssssi", $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $data_garantia, $manutencao_novo, $tag);
            
            if (!$stmt->execute()) {
                throw new Exception("Erro ao atualizar no controle: " . $stmt->error);
            }

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
            
                // Preparação da primeira consulta
                $sql_controle = "INSERT INTO chs_controle (equipamento_id, tag, modelo, problema, data_envio, situacao, previsao, retorno, garantia, manutencao) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_controle = $conn->prepare($sql_controle);

                if (!$stmt_controle) {
                    throw new Exception("Erro ao preparar a consulta para inserção no controle: " . $conn->error);
                }

                // Associação dos parâmetros
                $stmt_controle->bind_param("isssssssss", $id_equip, $tag, $modelo, $problema, $data_envio, $situacao, $data_previsao, $data_retorno, $data_garantia, $manutencao);

                // Execução da primeira consulta
                if (!$stmt_controle->execute()) {
                    throw new Exception("Erro ao inserir no controle: " . $stmt_controle->error);
                }

                // Obtendo o ID inserido
                $tag_id = $stmt_controle->insert_id;

                // Preparação da segunda consulta
                $sql_historico = "INSERT INTO chs_historico (tag_id, usuario_id) VALUES (?, ?)";
                $stmt_historico = $conn->prepare($sql_historico);

                if (!$stmt_historico) {
                    throw new Exception("Erro ao preparar a consulta para inserção no histórico: " . $conn->error);
                }

                // Associação dos parâmetros
                $stmt_historico->bind_param("ii", $tag_id, $usuario);

                // Execução da segunda consulta
                if (!$stmt_historico->execute()) {
                    throw new Exception("Erro ao inserir no histórico: " . $stmt_historico->error);
                }
            
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
    }
}
$conn->close();