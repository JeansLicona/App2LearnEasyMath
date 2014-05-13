<?php

function validate($nombres, $apellidos, $seccion, $correo, $fechaNacimiento, $contrasena, $confirmContra) {
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
    if (isEmpty($contrasena)) {
        $mensaje[] = "La contraseña no puede ser vacio.<br />";
    }
    if (!isEmail($correo)) {
        $mensaje[] = "Correo no tiene un formato adecuado de email.<br />";
    }
    if ($confirmContra != $contrasena) {
        $mensaje[] = "La contraseña no coinciden con la confirmacion. <br />";
    }
    if (!existDate($fechaNacimiento, "Y/m/d")) {
        $mensaje[] = "La fecha no tiene el formato adecuado.";
    }
    return $mensaje;
}

include_once '../util/Validations.php';
include '../util/ComandosBD.php';
if (isset($_POST['seccion']) && isset($_POST['nombres']) &&
        isset($_POST['apellidos']) && isset($_POST['fecha_nacimiento']) &&
        isset($_POST['correo']) && isset($_POST['contrasena']) &&
        isset($_POST['confirmPassword'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $seccion = $_POST['seccion'];
    $correo = $_POST['correo'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $contrasena = $_POST['contrasena'];
    $confirmContra = $_POST['confirmPassword'];
    $message = validate($nombres, $apellidos, $seccion, $correo, $fechaNacimiento, $contrasena, $confirmContra);
    if (empty($message)) {
        $fechaIngreso = new DateTime("now");
        $comandoUtil = new ComandosBD();
        $comandoUtil->beginTransaction();
        $isSave = true;
        $isSave&=$comandoUtil->insert("usuario", array(
            'nombre_usuario' => $correo,
            'contrasena' => crypt($contrasena),
            'tipo_usuario' => 2,
        ));
        $IDUsuario = $comandoUtil->lastInsertedId('usuario');
        $isSave&=$comandoUtil->insert("tutor", array('nombres' => $nombres,
            'apellidos' => $apellidos,
            'seccion' => $seccion,
            'fecha_nacimiento' => $fechaNacimiento,
            'fecha_ingreso' => $fechaIngreso->format("Y-m-d"),
            'correo' => $correo,
            'usuario' => $IDUsuario));
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
