<?php
if (isset($_GET['id'])) {
    include_once '../util/ComandosBD.php';
    $comandosBD = new ComandosBD();
    $tutores = $comandosBD->query(array('from'=>'tutor','where' => 'id_tutor=:id',
        'params' => array(':id'=>$_GET['id'])));
    $tutor=$tutores[0];
    ?>
    <div id="dialog-update" title="Actualizacion de tutor <?php echo $tutor['apellidos'] . " " . $tutor['nombres']; ?>">
        <div id="error-update"></div>
        <form action="../tutor/update.php?id=<?php echo $tutor['id_tutor']; ?>" id="dialog-update-form" method="post">
            <p>
                Nombres <br />
                <input type="text" id="nombres" size="41" name="nombres" 
                       value="<?php echo $tutor['nombres'];?>" placeholder="Nombres" /><br/>
                Apellidos <br />
                <input type="text" id="apellidos" size="41" name="apellidos" 
                       value="<?php echo $tutor['nombres'];?>" placeholder="Apellidos" /><br/>
                Secci&oacute;n <br />
                <input type="text" id="seccion" size="41" name="seccion" 
                       value="<?php echo $tutor['seccion'];?>" placeholder="Sección" /><br/>
                Fecha de nacimiento <br />
                <input type="text" id='fecha_nacimiento' size="41" name='fecha_nacimiento'
                       value="<?php echo $tutor['fecha_nacimiento'];?>" placeholder="Fecha de nacimiento" class="fecha"><br/>
                Correo <br /> 
                <input type="text" id="correo" size="41" name="correo" 
                       value="<?php echo $tutor['correo'];?>" placeholder="Correo" /><br/>
                <input type="submit" value="Guardar">
            </p>
        </form>
    </div>
    <?php
}
?>
