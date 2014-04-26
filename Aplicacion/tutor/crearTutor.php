<?php

    include '../util/ComandosBD.php';
    if (isset($_POST['seccion']) && isset($_POST['nombres']) &&
            isset($_POST['apellidos']) && isset($_POST['fecha_nacimiento']) &&
            isset($_POST['correo']) && isset($_POST['contrasena'])) {
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $seccion = $_POST['seccion'];
        $correo = $_POST['correo'];
        $fechaNacimiento = $_POST['fecha_nacimiento'];
        $contrasena = $_POST['contrasena'];
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
                'content' => "Ocurrio un error al guardar los datos");
        }
        echo json_encode($result);
    }
?>
