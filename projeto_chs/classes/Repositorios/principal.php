<?php

class Principal
{
    public function buscaDados($conn)
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
        ORDER BY 
            a.id ASC";
        
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $query = $resultado->fetch_all(MYSQLI_ASSOC);
            return $query;
        }

        return false;
    }
}
?>
