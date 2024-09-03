<?php
if(!isset($_SESSION)){
    session_start();
    $usuarioExiste = true;
}

if (!isset($_SESSION['id'])){
    die("Faca login <p> <a href=\"../login.php\">Entrar</a></p>");
}
?>