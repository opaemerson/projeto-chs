<?php
require_once('../../config.php');

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if(!empty($id)){
        $select = "SELECT ch.id FROM chs_historico ch
        INNER JOIN chs_controle cc
        ON cc.id = ch.tag_id
        WHERE cc.equipamento_id = $id;";

        $resultado = $config->conn->query($select);

        if($resultado == FALSE){
            return false;
        }

        $historico_id = [];

        while ($row = $resultado->fetch_assoc()) {
            $historico_id[] = $row['id'];
        }

        foreach($historico_id as $h){
            $delete = "DELETE FROM chs_historico WHERE id = $h";

            $conexao = $config->conn->query($delete);

            if($conexao == FALSE){
                continue;
            }
        }

        $delete = "DELETE FROM chs_controle WHERE equipamento_id = $id";

        $resultado = $config->conn->query($delete);

        if ($resultado == FALSE){
            return false;
        }

        $delete = "DELETE FROM chs_equipamento WHERE id = $id";

        $resultado = $config->conn->query($delete);

        if ($resultado !== FALSE) {
            $resposta['success'] = true;
            $config->conn->close();
            echo json_encode($resposta);
            return true;
        }

        return false;
    }
}
?>