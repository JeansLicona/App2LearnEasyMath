<?php

    function buscarPlanes($planGuardado) {
        $planSelec = "";
        $query = new ComandosBD();
        $planesEle = $query->query(array('from' => 'plan'));
        $planSelec.='<select id="plan" name="plan" placeholder="Plan">';
        foreach ($planesEle as $plan) {
            if($planGuardado==$plan['id_plan']){
                $planSelec.='<option value="' . $plan['id_plan'] . '" selected="selected">' . $plan['nombre'] . '</option>';
            }  else {
                $planSelec.='<option value="' . $plan['id_plan'] . '">' . $plan['nombre'] . '</option>';
            }
        }
        $planSelec.='</select> <br />';
        return $planSelec;
    }

    function buscarTutor($tutorGuardado) {
        $responsableSelec = "";
        $query = new ComandosBD();
        $tutores = $query->query(array('from' => 'tutor'));
        $responsableSelec.='<select id="tutor" name="tutor" placeholder="Tutor">';
        foreach ($tutores as $tutor) {
            $nombre = $tutor['nombres'] . " " . $tutor['apellidos'];
            if($tutorGuardado==$tutor['id_tutor']){
               $responsableSelec.='<option value="' . $tutor['id_tutor'] . '" selected="selected">' . $nombre . '</option>'; 
            }else{
                $responsableSelec.='<option value="' . $tutor['id_tutor'] . '">' . $nombre . '</option>';
            }
        }
        $responsableSelec.='</select> <br />';
        return $responsableSelec;
    }

    if (isset($_GET['id'])) {
        include_once '../util/ComandosBD.php';
        $comandosBD = new ComandosBD();
        $grupos = $comandosBD->query(array('from' => 'grupo', 'where' => 'id_grupo=:id',
            'params' => array(':id' => $_GET['id'])));
        $grupo = $grupos[0];
        ?>
        <div id="dialog-update" title="Actualizacion de grupo <?php echo $grupo['nombre'] ?>">
            <div id="error-update"></div>
            <form action="../grupo/update.php?id=<?php echo $grupo['id_grupo']; ?>" id="dialog-update-form" method="post">
                <p>
                    Nombre <br />
                    <input type="text" id="nombre" size="41" name="nombre"
                           value="<?php echo $grupo['nombre']; ?>" placeholder="Nombre" /><br/>
                    Fecha desintegraci&oacute;n <br /> 
                    <input type="text" id='fecha_fin' name='fecha_fin' 
                           value="<?php echo $grupo['fecha_desintegracion']; ?>" placeholder="Fecha Desintegración" class="fecha"> <br />
                    Plan Procedente <br /> 
                    <?php echo buscarPlanes($grupo['plan']); ?>
                    Tutor <br /> 
                    <?php echo buscarTutor($grupo['tutor']); ?>
                    <input type="submit" value="Guardar">
                </p>
            </form>
        </div>
        <?php
    }
?>
