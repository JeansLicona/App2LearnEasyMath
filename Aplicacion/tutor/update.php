<?php

function validate($nombres, $apellidos, $seccion, $correo, $fechaNacimiento) {
    $mensaje = array();
    if (isEmpty($nombres)) {
        $mensaje[] = "Nombres no puede ser vacio.\n";
    }
    if (isEmpty($apellidos)) {
        $mensaje[] = "Apellidos no puede ser vacio.<br />";
    }
    if (isEmpty($correo)) {
        $mensaje[] = "El correo del alumno no puede ser vacio.<br />";
    }
    if (isEmpty($fechaNacimiento)) {
        $mensaje[] = "Fecha de nacimiento no puede ser vacio.<br />";
    }
    if (isEmpty($seccion)) {
        $mensaje[] = "Seccion no puede ser vacio.<br />";
    }
    if (!isEmail($correo)) {
        $mensaje[] = "Correo no tiene un formato adecuado de email.<br />";
    }
    if (!existDate($fechaNacimiento, "Y/m/d")) {
        $mensaje[] = "La fecha no tiene el formato adecuado.";
    }
    return $mensaje;
}

include_once '../util/Validations.php';
if (isset($_POST['seccion']) && isset($_POST['nombres']) &&
        isset($_POST['apellidos']) && isset($_POST['fecha_nacimiento']) &&
        isset($_POST['correo']) && isset($_GET['id'])) {
    include_once '../util/ComandosBD.php';
    $comandosBD = new ComandosBD();
    $infoTutores = $comandosBD->query(array('from' => 'tutor', 'where' => 'id_tutor=:id_tutor',
        'join' => 'INNER JOIN usuario on usuario=id_usuario',
        'params' => array(':id_tutor' => $_GET['id'])));
    if (!empty($infoTutores)) {
        $infoTutor = $infoTutores[0];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $seccion = $_POST['seccion'];
        $correo = $_POST['correo'];
        $fechaNacimiento = $_POST['fecha_nacimiento'];
        $message = validate($nombres, $apellidos, $seccion, $correo, $fechaNacimiento);
        if (empty($message)) {
            $isSave = true;
            $comandosBD->beginTransaction();
            $comandosBD->update('usuario', array('nombre_usuario' => $correo), 'id_usuario=:id_usuario', array(':id_usuario' => $infoTutor['id_usuario']));
            $isSave&=$comandosBD->update('tutor', array('nombres' => $nombres,
                'apellidos' => $apellidos, 'seccion' => $seccion,
                'fecha_nacimiento' => $fechaNacimiento, 'correo' => $correo), 'id_tutor=:id_tutor', array(':id_tutor' => $infoTutor['id_tutor']));
            if ($isSave) {
                $comandosBD->commit();
                $result = array('status' => 'success');
            } else {
                $comandosBD->rollback();
                $result = array('status' => 'error',
                    'message' => "Ocurrio un error al guardar los datos");
            }
        } else {
            $result = array('status' => 'error',
                'message' => $message);
        }
        echo json_encode($result);
    }
}
?>
