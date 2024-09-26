<?php
if(!isset($_SESSION)){
    session_start();
    $usuarioExiste = true;
}

if (!isset($_SESSION['id'])) {
    die('<a style="text-align:center;" href="../login.php">Entrar</a>');
}

?>