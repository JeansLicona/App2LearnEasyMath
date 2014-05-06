<?php
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
                           value="<?php echo $plan['nombre'];?>" placeholder="Nombre" /><br/>
                    Material <br /> 
                    <input type="text" id='material' name='material'
                           value="<?php echo $plan['carpeta_material'];?>" placeholder="Material"> <br />
                    Plan Procedente <br /> 
                    <input type="text" id='plan' name='plan' 
                           value="<?php echo $plan['plan_procedente'];?>" placeholder="Plan Procedente"> <br />
                    Tarea <br /> 
                    <input type="text" id='tarea' name='tarea'
                           value="<?php echo $plan['tarea'];?>" placeholder="Tarea"> <br />
                    <input type="submit" value="Guardar">
                </p>
            </form>
        </div>
        <?php
    }
?>
