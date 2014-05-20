<?php

    session_start();
    if(isset($_GET['idTarea']) && !empty($_GET['idTarea']) && is_numeric($_GET['idTarea'])){
        include_once '../util/ComandosBD.php';
        $query = new ComandosBD();
        $tareaSeleccionada = $query->query(array('from' => 'tarea',  'where' => 'id_tarea=:id',
            'params' => array(':id' => $_GET['idTarea'])));
        $tarea = $tareaSeleccionada[0];
        $contenido=$tarea['contenido'];
        echo json_encode(array('content'=>$contenido));
    }
?>
