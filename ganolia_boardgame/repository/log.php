<?php
class Log {
    public function buscaLog($conn){
        $sql = "SELECT gh.evento, gp.nome , gp.classe , gp.sessao, gh.horario, gh.item_usado
        from ganolia_historico gh 
        inner join ganolia_personagem gp 
        on gp.id = gh.personagem_id
        order by gh.horario asc";

        $return = $conn->query($sql);

        if($return == false){
            return false;
        }

        $row = $return->fetch_all(MYSQLI_ASSOC);

        return $row;
    }
}
?>