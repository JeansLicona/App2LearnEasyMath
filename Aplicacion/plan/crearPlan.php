<?php

function validate($nombre, $material, $plan, $tarea) {
    $mensaje = array();
    if (isEmpty($nombre)) {
        $mensaje[] = "Nombre no puede ser vacio.<br />";
    }
    if (isEmpty($material)) {
        $mensaje[] = "Material no puede ser vacio.<br />";
    }
    if (isEmpty($tarea)) {
        $mensaje[] = "Tarea no puede ser vacio.<br />";
    }
    if (isEmpty($plan)) {
        $mensaje[] = "Plan no puede ser vacio.<br />";
    }
    return $mensaje;
}

include_once '../util/Validations.php';
include '../util/ComandosBD.php';
if (isset($_POST['nombre']) && isset($_POST['material']) && isset($_POST['plan']) && isset($_POST['tarea'])) {
    $nombre = $_POST['nombre'];
    $material = $_POST['material'];
    $plan = $_POST['plan'];
    $tarea = $_POST['tarea'];
    $message = validate($nombre, $material, $plan, $tarea);
    if (empty($message)) {
        $fecha = new DateTime("now");
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->insert("plan", array(
            'nombre' => $nombre,
            'fecha_creacion' => $fecha->format('Y-m-d'),
            'carpeta_material' => $material,
            'plan_procedente' => $plan,
            'tarea' => $tarea,
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
