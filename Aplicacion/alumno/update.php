<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($_POST['institucion']) && isset($_POST['nombres']) &&
        isset($_POST['apellidos']) && isset($_POST['correo']) && isset($_POST['matricula']) &&
        isset($_POST['informacion_adicional']) && isset($_GET['id'])) {
    include_once '../util/ComandosBD.php';
    $comandosBD = new ComandosBD();
    $infoAlumnos = $comandosBD->query(array('from' => 'alumno', 'where' => 'id_alumno=:id_alumno',
        'join' => 'INNER JOIN usuario on usuario=id_usuario',
        'params'=>array(':id_alumno'=>$_GET['id'])));
    if (!empty($infoAlumnos)) {
        $infoAlumno = $infoAlumnos[0];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $institucion = $_POST['institucion'];
        $correo = $_POST['correo'];
        $matricula = $_POST['matricula'];
        $isSave=true;
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
        echo json_encode($result);
    }
}
?>
