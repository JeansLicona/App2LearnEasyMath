<?php
    if (isset($_GET['id'])) {
        include_once '../util/ComandosBD.php';
        $comandosBD = new ComandosBD();
        $grupos = $comandosBD->query(array('from' => 'grupo', 'where' => 'grupo=:id',
            'params' => array(':id' => $_GET['id'])));
        $grupo = $grupos[0];
        ?>
        <div id="dialog-update" title="Actualizacion de grupo <?php echo $grupo['nombre'] ?>">
            <div id="error-update"></div>
            <form action="../grupo/update.php?id=<?php echo $grupo['id_plan']; ?>" id="dialog-update-form" method="post">
                <p>
                    Nombre <br />
                    <input type="text" id="nombre" size="41" name="nombre"
                           value="<?php echo $grupo['nombre'];?>" placeholder="Nombre" /><br/>
                    Fecha desintegraci&oacute;n <br /> 
                    <input type="text" id='fecha_fin' name='fecha_fin' 
                           value="<?php echo $grupo['fecha_desintegracion'];?>" placeholder="Fecha Desintegración" class="fecha"> <br />
                    Grupo <br /> 
                    <input type="text" id='grupo' name='grupo' 
                           value="<?php ?>" placeholder="Grupo"> <br />
                    Tutor <br /> 
                    <input type="text" id='tutor' name='tutor'
                           value="<?php echo $grupo['plan'];?>" placeholder="Tutor"> <br />
                    Plan <br /> 
                    <input type="text" id='plan' name='plan'
                           value="<?php echo $grupo['tutor'];?>" placeholder="Plan"> <br />
                    <input type="submit" value="Guardar">
                </p>
            </form>
        </div>
        <?php
    }
?>
