<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once('../../config.php');
require_once('../classes/servicoPrincipal.php');

$servico = new Servico();
$config = new Config();

$id = $_POST['id'];
$usuario = $_POST['idUsuario'];
$usuarioSessao = $_POST['usuarioSessao'];
$permissaoSessao = $_POST['permissaoSessao'];

$queryRegistros = $servico->buscaGenerica('a.*', 'chs_historico a', 'WHERE tag_id = ' . $id . ' order by id desc');

$usuarioConsultado = $queryRegistros[0]['usuario_id'];
$idHistorico= $queryRegistros[0]['id'];
    

try {
    if ($usuarioConsultado !== $usuarioSessao && $permissaoSessao !== 'Admin'){
        throw new Exception("Você não tem permissão para remover este item");
    }

    $sqlDeleteHistorico = "DELETE FROM chs_historico WHERE tag_id = $id";
    
    if ($config->conn->query($sqlDeleteHistorico) === false) {
        throw new Exception("Erro ao remover o item histórico");
    }

    $sqlDelete = "DELETE FROM chs_controle WHERE id = $id";
    
    if ($config->conn->query($sqlDelete) === false) {
        throw new Exception("Erro ao remover o item controle");
    }

    $resposta = ['erro' => 0, 'mensagem' => 'Item removido com sucesso!'];
    echo json_encode($resposta);

} catch (Exception $e) {
    $resposta = ['erro' => 1, 'mensagem' => $e->getMessage()];
    echo json_encode($resposta);
}

?>
