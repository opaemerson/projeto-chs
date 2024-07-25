<?php
session_start();
include_once "../config.php";
require_once('classes/servicoPrincipal.php');

$servico = new Servico();
$config = new Config();
$usuario = $config->pegaSessaoUsuario();

$queryRegistros = $servico->buscaDados();

?>
<div class='table-responsive'>
    <table class='table table-striped table-bordered amarelo-papel borda-preta'>
        <thead>
            <tr>
                <th>Equipamento</th>
                <th>TAG</th>
                <th>Marca</th>
                <th>Problema</th>
                <th>Data de Envio</th>
                <th>Situacao</th>
                <th>Previsao de Retorno</th>
                <th>Data_Retorno</th>
                <th>Garantia</th>
                <th>Manutencao</th>
                <th>Usuario</th>
                <th style='text-align: center'>Ações</th>
            </tr>
        </thead>
    <tbody>
<?php

foreach($queryRegistros as $registro){
    if ($registro['situacao'] === 'Enviado') {
        $situacaoTd = $registro['situacao'] . ' <img src="../Images/CHS/enviadow.png" class="img-enviado" alt="Enviado" width="30" height="30">';
    } elseif ($registro['situacao'] === 'Pendente') {
        $situacaoTd = $registro['situacao'] . ' <img src="../Images/CHS/pendente.png" class="img-enviado" alt="Pendente" width="30" height="30">';
    } elseif ($registro['situacao'] === 'Concluido') {
        $situacaoTd = $registro['situacao'] . ' <img src="../Images/CHS/concluido.png" class="img-enviado" alt="Concluido" width="30" height="30">';
    }

    echo "<tr>";
    echo "<td>{$registro['equipamento']}</td>";
    echo "<td>{$registro['tag']}</td>";
    echo "<td>{$registro['modelo']}</td>";
    echo "<td>{$registro['problema']}</td>";
    echo "<td>{$registro['data_envio']}</td>";
    echo "<td>{$situacaoTd}</td>";
    echo "<td>{$registro['previsao']}</td>";
    echo "<td>{$registro['retorno']}</td>";
    echo "<td>{$registro['garantia']}</td>";
    echo "<td>{$registro['manutencao']}</td>";
    echo "<td>{$registro['usuario']}</td>";
    echo "<td class='td-center'>
            <div class='btn-center' style='text-align: center'>
                <button type='button' class='btn btn-link' data-bs-toggle='modal' data-bs-target='#editModal' onclick=\"lerUsuario({$registro['id']})\">
                    <img src='../Images/CHS/editar.png' width='30' height='30'>
                </button>
                <button type='button' class='btn btn-link' onclick=\"concluirEvento({$registro['id']})\">
                    <img src='../Images/CHS/concluido.png' width='30' height='30'>
                </button>
                <button type='button' class='btn btn-link' onclick=\"remove({$registro['id']}, '{$registro['idUsuario']}', '{$usuario['usuarioSessao']}', '{$usuario['permissaoSessao']}')\">
                    <img src='../Images/CHS/excluir.png' width='30' height='30'>
                </button>
            </div>
        </td>";
    echo "</tr>";
}
?>

<script src="./scripts/index.js"></script>
