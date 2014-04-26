<?php

   if (isset($_POST['seccion']) && isset($_POST['nombres']) &&
            isset($_POST['apellidos']) && isset($_POST['fecha_nacimiento']) &&
            isset($_POST['correo'])  && isset($_GET['id'])) {
    include_once '../util/ComandosBD.php';
    $comandosBD = new ComandosBD();
    $infoTutores = $comandosBD->query(array('from' => 'tutor', 'where' => 'id_tutor=:id_tutor',
        'join' => 'INNER JOIN usuario on usuario=id_usuario',
        'params'=>array(':id_tutor'=>$_GET['id'])));
    if (!empty($infoTutores)) {
        $infoTutor = $infoTutores[0];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $seccion = $_POST['seccion'];
        $correo = $_POST['correo'];
        $fechaNacimiento = $_POST['fecha_nacimiento'];
        $isSave=true;
        $comandosBD->beginTransaction();
        $comandosBD->update('usuario', array('nombre_usuario' => $correo), 'id_usuario=:id_usuario', array(':id_usuario' => $infoTutor['id_usuario']));
        $isSave&=$comandosBD->update('tutor', array('nombres' => $nombres,
            'apellidos' => $apellidos, 'seccion' => $seccion,
            'fecha_nacimiento' => $fechaNacimiento ,'correo' => $correo), 'id_tutor=:id_tutor', array(':id_tutor' => $infoTutor['id_tutor']));
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