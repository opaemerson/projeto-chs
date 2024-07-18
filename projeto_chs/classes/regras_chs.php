<?php
require_once('C:/xampp/htdocs/portfolio/config.php');

class Regras{

    public function limite_cinco($usuario, $tabela){

        global $conn;
        $sql = '';

        switch ($tabela) {
            case 'chs_controle':
                $sql = "SELECT count(0) as count from chs_controle a
                    left join usuarios c 
                    on c.id = (select x.usuario_id from chs_historico x where x.tag_id = a.id)
                    where c.id = $usuario";
                break;
            
            default:
                $sql = "SELECT count(0) as count from $tabela a
                    left join usuarios c 
                    on c.id = a.usuario_id
                    where c.id = $usuario";
                break;
        }
        

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