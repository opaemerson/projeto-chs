<?php

class Problema
{
    public function buscaProblema($conn)
    {
        $sql = "SELECT id, nome, tipo FROM chs_problema";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $problemas = $resultado->fetch_all(MYSQLI_ASSOC);
            return $problemas;
        }

        return false;
    }
}
?>
