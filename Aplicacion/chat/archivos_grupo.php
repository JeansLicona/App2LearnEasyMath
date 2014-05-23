<?php

    include_once '../util/ComandosBD.php';

    if(isset($_GET['id_grupo']) && !empty($_GET['id_grupo']) && is_numeric($_GET['id_grupo'])){
       
        $grupo=$_GET['id_grupo'];
        $query = new ComandosBD();
        
        $grupoSeleccionado=$query->query(array('from' => 'grupo' , 'where' => 'id_grupo=:id',
                  'params' => array(':id' => $grupo) ));
        $grupoSelec=$grupoSeleccionado[0];
        
        $planSeleccionado=$query->query(array('from' => 'plan' , 'where' => 'id_plan=:id',
                  'params' => array(':id' => $grupoSelec['plan']) ));
        $planSelec=$planSeleccionado[0];
        
        $tareasEle = $query->query(array('from' => 'tarea' , 'where' => 'id_tarea=:id',
                  'params' => array(':id' => $planSelec['tarea']) ));
        $tareaSelec = '<select id="tarea" name="tarea" placeholder="Tarea" onchange="desplegarTexto(this)">';
        $tareaSelec.='<option>Seleccione Tarea</option>';
        foreach ($tareasEle as $tarea) {
            $tareaSelec.='<option value="' . $tarea['id_tarea'] . '">' . $tarea['nombre'] . '</option>';
        }
        $tareaSelec.='</select> <br />';
    

   
        $archivosEle = $query->query(array('from' => 'archivo'  , 'where' => 'grupo=:id',
                  'params' => array(':id' => $grupo) ));
        $archivoSelec = '<select id="archivo_gp" name="archivo_gp" placeholder="Archivo" onchange="desplegarArchivo(this)">';
        $archivoSelec.='<option>Seleccione Archivo</option>';
        foreach ($archivosEle as $archivo) {
            $archivoSelec.='<option value="' . $archivo['id_archivo'] . '">' . $archivo['nombre'] . '</option>';
        }
        $archivoSelec.='</select> <br />';
        
        echo json_encode(array('archivo'=>$archivoSelec,'tarea'=>$tareaSelec));
    }
        
    

?>
