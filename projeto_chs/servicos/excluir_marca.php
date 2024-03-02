<?php
require_once('../../config.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if(!empty($id)){

        $delete = "DELETE FROM chs_marca WHERE id = $id";

        $resultado = $conn->query($delete);

        if ($resultado !== FALSE) {
            $resposta['success'] = true;
            $conn->close();
            echo json_encode($resposta);
            return true;
        }

        return false;
    }
}
?>