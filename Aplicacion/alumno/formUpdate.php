
<?php
if (isset($_GET['id'])) {
    include_once '../util/ComandosBD.php';
    $comandosBD = new ComandosBD();
    $alumnos = $comandosBD->query(array('from'=>'alumno','where' => 'id_alumno=:id_alumno',
        'params' => array(':id_alumno'=>$_GET['id'])));
    if(!empty($alumnos)){
        
    }
    $alumno=$alumnos[0];
    ?>
    <div id="dialog-update" title="Actualizacion de alumno <?php echo $alumno['apellidos'] . " " . $alumno['nombres']; ?>">
        <div id="error-update"></div>
        <form action="../alumno/update.php?id=<?php echo $alumno['id_alumno']; ?>" id="dialog-update-form" method="post">
            <p>
                Nombres <br />
                <input type="text" id="nombres" size="41" name="nombres" 
                       value="<?php echo $alumno['nombres'];?>" placeholder="Nombres" /><br/>
                Apellidos <br />
                <input type="text" id="apellidos" size="41" name="apellidos" 
                       value="<?php echo $alumno['nombres'];?>" placeholder="Apellidos" /><br/>
                Matricula <br />
                <input type="text" id="matricula" size="41" name="matricula" 
                       value="<?php echo $alumno['matricula'];?>" placeholder="Matricula" /><br/>
                Institucion <br />
                <input type="text" id="institucion" size="41" name="institucion"
                       value="<?php echo $alumno['institucion'];?>" placeholder="Institucion" /><br/>
                Correo <br /> 
                <input type="text" id="correo" size="41" name="correo" 
                       value="<?php echo $alumno['correo'];?>" placeholder="Correo" /><br/>
                Informacion adicional <br />
                <textarea type="text" id="informacion_adicional" name="informacion_adicional" 
                          value="<?php echo $alumno['informacion_adicional'];?>" cols="40" rows="2" placeholder="Informacion adicional..." ></textarea>
                <input type="submit" value="Guardar">
            </p>
        </form>
    </div>
    <?php
}
?>