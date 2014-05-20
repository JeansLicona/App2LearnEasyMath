<?php

    session_start();
    if(isset($_GET['idArchivo']) && !empty($_GET['idArchivo']) && is_numeric($_GET['idArchivo'])){
        include_once '../util/ComandosBD.php';
        $query = new ComandosBD();
        $archivoSeleccionado=$query->query(array('from' => 'archivo',  'where' => 'id_archivo=:id',
            'params' => array(':id' => $_GET['idArchivo'])));
        $archivo=$archivoSeleccionado[0];
        $pagina='<div id="archivo" name="archivo">';
        if($archivo['tipo_archivo']==1){
            $pagina.='<embed src="'.$archivo['url'].'" width="600" height="400">';
        }else{
            if($archivo['tipo_archivo']==2){
              $pagina.='<img src="'.$archivo['url'].'" border="1" width="600" height="300">';  
            }
        }
        $pagina.=' </div>';
        echo json_encode(array('archivo'=>$pagina));
    }
?>
