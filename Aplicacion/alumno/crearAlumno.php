<?php

function validate($nombres, $apellidos, $institucion, $correo, $fechaNacimiento,
        $matricula, $contrasena, $confirmContra) {
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
    if (isEmpty($fechaNacimiento)) {
        $mensaje[] = "La fecha de nacimiento del alumno no puede ser vacio.<br />";
    }
    if (isEmpty($matricula)) {
        $mensaje[] = "La matricula del alumno no puede ser vacio.<br />";
    }
    if (isEmpty($contrasena)) {
        $mensaje[] = "La contraseña no puede ser vacio.<br />";
    }
    if (!isEmail($correo)) {
        $mensaje[] = "Correo no tiene un formato adecuado de email.<br />";
    }
    if($confirmContra!=$contrasena){
        $mensaje[]="La contraseña no coinciden con la confirmacion. <br />";
    }
    if(!existDate($fechaNacimiento, "Y/m/d")){
        $mensaje[]="La fecha no tiene el formato adecuado.";
    }
    return $mensaje;
}

include_once '../util/ComandosBD.php';
include_once '../util/Validations.php';


if (isset($_POST['institucion']) && isset($_POST['nombres']) &&
        isset($_POST['apellidos']) && isset($_POST['fecha_nacimiento']) &&
        isset($_POST['correo']) && isset($_POST['matricula']) &&
        isset($_POST['informacion_adicional']) && isset($_POST['contrasena'])
        && isset($_POST['confirmPassword'])) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $institucion = $_POST['institucion'];
    $correo = $_POST['correo'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $matricula = $_POST['matricula'];
    $contrasena = $_POST['contrasena'];
    $confirmContra=$_POST['confirmPassword'];
    $dateNow = new DateTime("now");
    $validateMsg = validate($nombres, $apellidos, $institucion, $correo, 
            $fechaNacimiento, $matricula, $contrasena, $confirmContra);
    
    if (empty($validateMsg)) {
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
    }else{
        $result=array('status'=>'error','message'=>$validateMsg);
    }
    echo json_encode($result);
}
?>
