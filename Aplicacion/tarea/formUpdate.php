<?php
if (isset($_GET['id'])) {
    include_once '../util/ComandosBD.php';
    $comandosBD = new ComandosBD();
    $tareas = $comandosBD->query(array('from'=>'tarea','where' => 'id_tarea=:id',
        'params' => array(':id'=>$_GET['id'])));
    $tarea=$tareas[0];
    ?>
    <div id="dialog-update" title="Actualizacion de tarea <?php echo $tarea['nombre']  ?>">
        <div id="error-update"></div>
        <form action="../tarea/update.php?id=<?php echo $tarea['id_tarea']; ?>" id="dialog-update-form" method="post">
            <p>
                Nombre <br />
                <input type="text" id="nombre" size="41" name="nombre" 
                       value="<?php echo $tarea['nombre'];?>" placeholder="Nombre" /><br/>
                Descripci&oacute;n <br />
                <input type="text" id="descripcion" size="41" name="descripcion" 
                       value="<?php echo $tarea['descripcion'];?>" placeholder="Descripción" /><br/>
                <input type="submit" value="Guardar">
            </p>
        </form>
    </div>
    <?php
}
?>
