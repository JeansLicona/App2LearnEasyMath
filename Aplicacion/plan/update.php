<?php

    include '../util/ComandosBD.php';
    if (isset($_POST['nombre']) && isset($_POST['material']) && 
            isset($_POST['plan']) && isset($_POST['tarea'])) {
        $nombre=$_POST['nombre'];
        $material=$_POST['material'];
        $plan=$_POST['plan'];
        $tarea=$_POST['tarea'];
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->update("plan", array(
            'nombre' => $nombre,
            'carpeta_material'=>$material,
            'plan_procedente' => $plan,
            'tarea'=>$tarea,
        ), 'id_plan=:id', array(':id' => $_GET['id']));
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
