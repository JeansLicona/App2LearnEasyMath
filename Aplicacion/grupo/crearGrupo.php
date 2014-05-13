<?php

function validate($nombre, $fechaDesintegracion, $tutor, $plan) {
    $mensaje = array();
    if (isEmpty($nombre)) {
        $mensaje[] = "Nombre no puede ser vacio.<br />";
    }
    if (isEmpty($fechaDesintegracion)) {
        $mensaje[] = "Fecha de desintegración no puede ser vacio.<br />";
    }
    if (isEmpty($tutor)) {
        $mensaje[] = "Tutor no puede ser vacio.<br />";
    }
    if (isEmpty($plan)) {
        $mensaje[] = "Plan no puede ser vacio.<br />";
    }
    return $mensaje;
}

include_once '../util/Validations.php';
include '../util/ComandosBD.php';

if (isset($_POST['nombre']) && isset($_POST['fecha_fin']) && isset($_POST['tutor']) && isset($_POST['plan'])) {
    $nombre = $_POST['nombre'];
    $fechaDesintegracion = $_POST['fecha_fin'];
    $tutor = $_POST['tutor'];
    $plan = $_POST['plan'];
    $message = validate($nombre, $fechaDesintegracion, $tutor, $plan);
    if (empty($message)) {
        $fecha = new DateTime("now");
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->insert("grupo", array(
            'nombre' => $nombre,
            'fecha_creacion' => $fecha->format('Y-m-d'),
            'fecha_desintegracion' => $fechaDesintegracion,
            'plan' => $plan,
            'tutor' => $tutor,
        ));
        if ($isSave) {
            $comandoUtil->commit();
            $result = array('status' => 'success');
        } else {
            $comandoUtil->rollback();
            $result = array('status' => 'error',
                'message' => "Ocurrio un error al guardar los datos");
        }
    } else {
        $result = array('status' => 'error',
            'message' => $message);
    }
    echo json_encode($result);
}
?>
