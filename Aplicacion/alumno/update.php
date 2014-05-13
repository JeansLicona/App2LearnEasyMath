<?php

function validate($nombres, $apellidos, $institucion, $correo, $matricula) {
    $mensaje = array();
    if (isEmpty($nombres)) {
        $mensaje[] = "El nombre del alumno no puede ser vacio.\n";
    }
    if (isEmpty($apellidos)) {
        $mensaje[] = "El appelido del alumno no puede ser vacio.<br />";
    }
    if (isEmpty($institucion)) {
        $mensaje[] = "Institución del alumno no puede ser vacio.<br />";
    }
    if (isEmpty($correo)) {
        $mensaje[] = "El correo del alumno no puede ser vacio.<br />";
    }
    if (isEmpty($matricula)) {
        $mensaje[] = "La matricula del alumno no puede ser vacio.<br />";
    }
    if (!isEmail($correo)) {
        $mensaje[] = "Correo no tiene un formato adecuado de email.<br />";
    }
    return $mensaje;
}

include_once '../util/Validations.php';

if (isset($_POST['institucion']) && isset($_POST['nombres']) &&
        isset($_POST['apellidos']) && isset($_POST['correo']) && isset($_POST['matricula']) &&
        isset($_POST['informacion_adicional']) && isset($_GET['id'])) {
    include_once '../util/ComandosBD.php';
    $comandosBD = new ComandosBD();
    $infoAlumnos = $comandosBD->query(array('from' => 'alumno', 'where' => 'id_alumno=:id_alumno',
        'join' => 'INNER JOIN usuario on usuario=id_usuario',
        'params' => array(':id_alumno' => $_GET['id'])));
    if (!empty($infoAlumnos)) {
        $infoAlumno = $infoAlumnos[0];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $institucion = $_POST['institucion'];
        $correo = $_POST['correo'];
        $matricula = $_POST['matricula'];
        $message = validate($nombres, $apellidos, $institucion, $correo, $matricula);
        if (empty($message)) {
            $isSave = true;
            $comandosBD->beginTransaction();
            $isSave&=$comandosBD->update('usuario', array('nombre_usuario' => $matricula), 'id_usuario=:id_usuario', array(':id_usuario' => $infoAlumno['id_usuario']));
            $isSave&=$comandosBD->update('alumno', array('nombres' => $nombres,
                'apellidos' => $apellidos, 'institucion' => $institucion, 'correo' => $correo,
                'matricula' => $matricula), 'id_alumno=:id_alumno', array(':id_alumno' => $infoAlumno['id_alumno']));
            if ($isSave) {
                $comandosBD->commit();
                $result = array('status' => 'success');
            } else {
                $comandosBD->rollback();
                $result = array('status' => 'error',
                    'content' => "Ocurrio un error al guardar los datos");
            }
        } else {
            $result = array('status' => 'error', 'message' => $message);
        }
        echo json_encode($result);
    }
}
?>
