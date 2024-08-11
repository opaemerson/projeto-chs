<?php

class Principal
{
    public function buscaDados($conn, $where)
    {
        $sql = "SELECT 
            a.*,
            (SELECT u.nome FROM chs_historico h INNER JOIN usuarios u ON u.id = h.usuario_id WHERE h.tag_id = a.id order by h.id DESC limit 1) as usuario,
            (SELECT u.id FROM chs_historico h INNER JOIN usuarios u ON u.id = h.usuario_id WHERE h.tag_id = a.id order by h.id DESC limit 1) as idUsuario,
            e.nome as equipamento
        FROM 
            chs_controle a
        LEFT JOIN 
            chs_equipamento e
        ON 
            e.id = a.equipamento_id
            $where
        ORDER BY 
            a.id ASC";
        
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $query = $resultado->fetch_all(MYSQLI_ASSOC);
            return $query;
        }

        return false;
    }

    public function buscaGenerica($conn, $select, $from, $where)
    {
        $sql = "SELECT $select FROM $from WHERE $where";

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $query = $resultado->fetch_all(MYSQLI_ASSOC);
            return $query;
        }

        return false;
    }

    public function limiteCinco($conn, $usuario, $tabela){

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
