<?php

function validate($nombre, $descripcion) {
    $mensaje = array();
    if (isEmpty($nombre)) {
        $mensaje[] = "Nombre no puede ser vacio.<br />";
    }
    if (isEmpty($descripcion)) {
        $mensaje[] = "Descripcion no puede ser vacio.<br />";
    }
    return $mensaje;
}

include_once '../util/Validations.php';
include '../util/ComandosBD.php';
if (isset($_POST['nombre']) &&
        isset($_POST['descripcion'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $message = validate($nombre, $descripcion);
    if (empty($message)) {
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->update("tarea", array(
            'nombre' => $nombre,
            'descripcion' => $descripcion,
                ), 'id_tarea=:id_tarea', array(':id_tarea' => $_GET['id']));
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
