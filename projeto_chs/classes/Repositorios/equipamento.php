<?php

class Equipamento
{
    public function buscaEquipamento($conn)
    {
        $sql = "SELECT id, nome, tipo FROM chs_equipamento";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $equipamentos = $resultado->fetch_all(MYSQLI_ASSOC);
            return $equipamentos;
        }

        return false;
    }
}
?>
