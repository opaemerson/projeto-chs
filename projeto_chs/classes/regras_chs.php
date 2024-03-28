<?php
require_once('../config.php');

class Regras{

    public function limite_cinco($usuario, $tabela){

        global $conn;

        $sql = "SELECT count(0) as count from $tabela a
        left join chs_historico b
        on b.tag_id = a.id
        left join usuarios c 
        on c.id = b.usuario_id
        where c.id = $usuario";

        $resultado = $conn->query($sql);

        if ($resultado === FALSE) {
            return false;
        }

        $row = $resultado->fetch_assoc();
        $count = $row["count"];

        if ($count >= 3) {
            return false;
        }
        
        return true;
    }
}
?>