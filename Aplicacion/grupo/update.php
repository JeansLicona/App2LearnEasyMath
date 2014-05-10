<?php

     include '../util/ComandosBD.php';
    if (isset($_POST['nombre']) && isset($_POST['fecha_fin']) 
           && isset($_POST['tutor']) && isset($_POST['plan'])) {
        $nombre=$_POST['nombre'];
        $fechaDesintegracion=$_POST['fecha_fin'];
        $tutor=$_POST['tutor'];
        $plan=$_POST['plan'];
        
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->update("grupo", array(
            'nombre' => $nombre,
            'fecha_desintegracion'=>$fechaDesintegracion,
            'plan' => $plan,
            'tutor'=>$tutor,
        ), 'id_grupo=:id', array(':id' => $_GET['id']));
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
