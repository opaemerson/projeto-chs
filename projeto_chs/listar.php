<?php
session_start();
include_once "../config.php";
require_once('classes/servicoPrincipal.php');

$servico = new Servico();
$config = new Config();
$usuario = $config->pegaSessaoUsuario();

$queryRegistros = $servico->buscaDados();

?>


<script src="./scripts/index.js"></script>
