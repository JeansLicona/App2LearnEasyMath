<?php

function validate($nombre, $descripcion, $responsable) {
    $mensaje = array();
    if (isEmpty($nombre)) {
        $mensaje[] = "Nombre no puede ser vacio.<br />";
    }
    if (isEmpty($descripcion)) {
        $mensaje[] = "Descripción no puede ser vacio.<br />";
    }
    if (isEmpty($responsable)) {
        $mensaje[] = "Responsable no puede ser vacio.<br />";
    }
    return $mensaje;
}

include_once '../util/Validations.php';
include '../util/ComandosBD.php';
if (isset($_POST['responsable']) && isset($_POST['nombre']) &&
        isset($_POST['descripcion'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $responsable = $_POST['responsable'];
    $message = validate($nombre, $descripcion, $responsable);
    if (empty($message)) {
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
                'message' => "Ocurrio un error al guardar los datos");
        }
    }else{
            $result = array('status' => 'error',
                'message' => $message);
    }
    echo json_encode($result);
}
?>
