<?php
require_once('../../config.php');

$config = new Config();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if(!empty($id)){

        $delete = "DELETE FROM chs_problema WHERE id = $id";

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