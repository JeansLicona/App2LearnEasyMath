<?php

include_once '../util/ComandosBD.php';


if (isset($_POST['institucion']) && isset($_POST['nombres']) &&
        isset($_POST['apellidos']) && isset($_POST['fecha_nacimiento']) &&
        isset($_POST['correo']) && isset($_POST['matricula']) &&
        isset($_POST['informacion_adicional']) && isset($_POST['contrasena'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $institucion = $_POST['institucion'];
    $correo = $_POST['correo'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $matricula = $_POST['matricula'];
    $contrasena = $_POST['contrasena'];
    $dateNow = new DateTime("now");

    $comandoUtil = new ComandosBD();
    $comandoUtil->beginTransaction();
    $isSave = true;
    $isSave&= $comandoUtil->insert("usuario", array(
        'nombre_usuario' => $matricula,
        'contrasena' => crypt($contrasena),
        'tipo_usuario' => 3,));
    $usuarioId = $comandoUtil->lastInsertedId('usuario');
    $isSave&=$comandoUtil->insert("alumno", array('nombres' => $nombres,
        'apellidos' => $apellidos,
        'institucion' => $institucion,
        'matricula' => $matricula,
        'fecha_nacimiento' => $fechaNacimiento,
        'fecha_ingreso' => $dateNow->format("Y-m-d"),
        'correo' => $correo,
        'usuario' => $usuarioId));
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
