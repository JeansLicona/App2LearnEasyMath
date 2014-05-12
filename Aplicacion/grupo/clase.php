<?php

    if (isset($_GET['id']) && isset($_POST['alumno'])) {
        include_once '../util/ComandosBD.php';
        $grupo=$_GET['id'];
        $alumno=$_POST['alumno'];
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->insert("clase", array(
            'grupo' => $grupo,
            'alumno' => $alumno,
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
