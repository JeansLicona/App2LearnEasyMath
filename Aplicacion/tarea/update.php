<?php

    include '../util/ComandosBD.php';
    if (isset($_POST['nombre']) &&
            isset($_POST['descripcion'])) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->update("tarea", array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
        ));
        if ($isSave) {
            $comandoUtil->commit();
            $result = array('status' => 'success');
        } else {
            $comandoUtil->rollback();
            $result = array('status' => 'error',
                'content' => "Ocurrio un error al guardar los datos");
        }
        echo json_encode($result);
    }
?>
