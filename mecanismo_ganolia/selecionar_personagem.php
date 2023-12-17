<?php
include('../protecao.php');
require_once('../config.php');
header('Access-Control-Allow-Origin: *');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_SESSION['id'];
}