<?php
if(!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION['id'])){
    die("Faca login <p> <a href=\"inicial.php\">Entrar</a></p>");
}
?>