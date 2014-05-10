<?php

    include '../util/ComandosBD.php';
    
    if (isset($_POST['nombre']) && isset($_POST['fecha_fin']) && isset($_POST['tutor']) && isset($_POST['plan'])) {
        $nombre=$_POST['nombre'];
        $fechaDesintegracion=$_POST['fecha_fin'];
        $tutor=$_POST['tutor'];
        $plan=$_POST['plan'];
        $fecha= new DateTime("now");
        
        
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->insert("grupo", array(
            'nombre' => $nombre,
            'fecha_creacion' => $fecha->format('Y-m-d'),
            'fecha_desintegracion'=>$fechaDesintegracion,
            'plan' => $plan,
            'tutor'=>$tutor,
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
