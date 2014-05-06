<?php

   include '../util/ComandosBD.php';
    if (isset($_POST['responsable']) && isset($_POST['nombre']) &&
            isset($_POST['descripcion'])) {
        $nombre=$_POST['nombre'];
        $descripcion=$_POST['descripcion'];
        $responsable=$_POST['responsable'];
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->insert("tarea", array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'responsable' => $responsable,
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
