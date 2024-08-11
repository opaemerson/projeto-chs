<?php

class Marca
{
    public function buscaMarca($conn)
    {
        $sql = "SELECT id, nome, tipo FROM chs_marca";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $marcas = $resultado->fetch_all(MYSQLI_ASSOC);
            return $marcas;
        }

        return false;
    }
}
?>
