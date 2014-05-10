<?php

    function buscarPlanes($planGuardado) {
        $planSelec = "";
        $query = new ComandosBD();
        $planesEle = $query->query(array('from' => 'plan'));
        $planSelec.='<select id="plan" name="plan" placeholder="Plan">
            <option value="Ninguno">Ninguno</option>';
        foreach ($planesEle as $plan) {
            if($planGuardado==$plan['nombre']){
                $planSelec.='<option value="' . $plan['nombre'] . '" selected="selected">' . $plan['nombre'] . '</option>';
            }else{
                $planSelec.='<option value="' . $plan['nombre'] . '">' . $plan['nombre'] . '</option>';
            }
        }
        $planSelec.='</select> <br />';
        return $planSelec;
    }

    function buscarTarea($tareaGuardada) {
        $tareaSelec = "";
        $query = new ComandosBD();
        $tareasEle = $query->query(array('from' => 'tarea'));
        $tareaSelec.='<select id="tarea" name="tarea" placeholder="Tarea">';
        foreach ($tareasEle as $tarea) {
            if($tareaGuardada==$tarea['id_tarea']){
                $tareaSelec.='<option value="' . $tarea['id_tarea'] . '" selected="selected">' . $tarea['nombre'] . '</option>';
            }else{
                $tareaSelec.='<option value="' . $tarea['id_tarea'] . '">' . $tarea['nombre'] . '</option>';
            }
        }
        $tareaSelec.='</select> <br />';
        return $tareaSelec;
    }

    if (isset($_GET['id'])) {
        include_once '../util/ComandosBD.php';
        $comandosBD = new ComandosBD();
        $planes = $comandosBD->query(array('from' => 'plan', 'where' => 'id_plan=:id',
            'params' => array(':id' => $_GET['id'])));
        $plan = $planes[0];
        ?>
        <div id="dialog-update" title="Actualizacion de plan <?php echo $plan['nombre'] ?>">
            <div id="error-update"></div>
            <form action="../plan/update.php?id=<?php echo $plan['id_plan']; ?>" id="dialog-update-form" method="post">
                <p>
                    Nombre <br />
                    <input type="text" id="nombre" size="41" name="nombre" 
                           value="<?php echo $plan['nombre']; ?>" placeholder="Nombre" /><br/>
                    Material <br /> 
                    <input type="text" id='material' name='material'
                           value="<?php echo $plan['carpeta_material']; ?>" placeholder="Material"> <br />
                    Plan Procedente <br /> 
                    <?php echo buscarPlanes($plan['plan_procedente']); ?>
                    Tarea <br /> 
                    <?php echo buscarTarea($plan['tarea']); ?>
                    <input type="submit" value="Guardar">
                </p>
            </form>
        </div>
        <?php
    }
?>
