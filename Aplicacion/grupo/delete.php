<?php

    if (isset($_GET['id'])) {
        include_once '../util/ComandosBD.php';
        $comandosBD = new ComandosBD();
        if ($comandosBD->delete('grupo', 'id_grupo=:id', array(':id' => $_GET['id']))) {
            $result = array('status' => 'success');
        } else {
            $result = array('status' => 'error',
                'content' => "Ocurrio un error al eliminar los datos");
        }
        echo json_encode($result);
    }
?>
