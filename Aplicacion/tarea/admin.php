<?php
include_once '../util/ComandosBD.php';

function buscarTutor() {
    $responsableSelec = "";
    $query = new ComandosBD();
    $tutores = $query->query(array('from' => 'tutor'));
    $responsableSelec.='<select id="responsable" name="responsable" placeholder="responsable">';
    foreach ($tutores as $tutor) {
        $nombre = $tutor['nombres'] . " " . $tutor['apellidos'];
        $responsableSelec.='<option value="' . $tutor['id_tutor'] . '">' . $nombre . '</option>';
    }
    $responsableSelec.='</select> <br />';
    return $responsableSelec;
}
?>

<?php
$USUARIO_ADMINISTRADOR = 1;
$USUARIO_TUTOR=2;
session_start();
if (isset($_SESSION['tipo_usuario'])) {
    if ($_SESSION['tipo_usuario'] == $USUARIO_ADMINISTRADOR ||
            $_SESSION['tipo_usuario'] == $USUARIO_TUTOR) {
        ?>
        <h1>Administracion de Tarea</h1>
        <a href="#" id="dialog-create-link" 
           class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"
           role="button" aria-disabled="false">
                <span class="ui-button-text">Agregar tarea</span></a>
        <div id="dialog-create" title="Alta de Tarea">
            <div id="error"></div>
            <form action="../tarea/crearTarea.php" id="dialog-create-form" method="post">
                <p>
                    Nombre <br />
                    <input type="text" id="nombre" size="41" name="nombre" placeholder="Nombre" /><br/>
                    Descripci&oacute;n <br />
                    <textarea type="text" id="descripcion" name="descripcion"
                              cols="40" rows="2" placeholder="Descripción..." ></textarea><br/>
                    Responsable <br /> 
                    <?php echo buscarTutor();
                    ?>
                    <input type="submit" value="Guardar">
                </p>
            </form>
        </div>
        <div id="update-contenedor">
        </div>
        <?php

        function addColumnTable($data) {
            echo '<td>';
            echo $data;
            echo '</td>';
        }

        $db = new ComandosBD();
        $tareas = $db->query(array('from' => 'tarea'));

        echo '<table id="admin-table">
    <thead>
    <tr>
      <th> Nombre </th>
      <th> Descripci&oacute;n </th>
      <th> Responsable </th>
      <th> Opciones </th>
   </tr>
   </thead>
   <tbody>';
        $db->beginTransaction();
        foreach ($tareas as $tarea) {
            $responsable = $db->query(array('from' => 'tutor', 'where' => 'id_tutor=:id',
                'params' => array(':id' => $tarea['responsable'])));
            $tutor = $responsable[0];
            echo '<tr>';
            addColumnTable($tarea['nombre']);
            addColumnTable($tarea['descripcion']);
            addColumnTable($tutor['apellidos'] . " " . $tutor['nombres']);
            addColumnTable('<a href="../tarea/formUpdate.php?id=' . $tarea['id_tarea'] . '" class="update-option">Editar tarea</a>
        <a href="../tarea/delete.php?id=' . $tarea['id_tarea'] . '" class="delete-option">Eliminar tarea</a>');
            echo '</tr>';
        }
        echo '
    </tbody>
    </table>';
    } else {
        ?>
        <h1>Error 403</h1>
        <p>No se tiene suficientes permisos</p>     
        <?php
    }
}
?>
