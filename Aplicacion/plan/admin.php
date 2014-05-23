<?php
include_once '../util/ComandosBD.php';

function buscarPlanes() {
    $planSelec = "";
    $query = new ComandosBD();
    $planesEle = $query->query(array('from' => 'plan'));
    $planSelec.='<select id="plan" name="plan" placeholder="Plan">
            <option value="Ninguno">Ninguno</option>';
    foreach ($planesEle as $plan) {
        $planSelec.='<option value="' . $plan['nombre'] . '">' . $plan['nombre'] . '</option>';
    }
    $planSelec.='</select> <br />';
    return $planSelec;
}

function buscarTarea() {
    $tareaSelec = "";
    $query = new ComandosBD();
    $tareasEle = $query->query(array('from' => 'tarea'));
    $tareaSelec.='<select id="tarea" name="tarea" placeholder="Tarea">';
    foreach ($tareasEle as $tarea) {
        $tareaSelec.='<option value="' . $tarea['id_tarea'] . '">' . $tarea['nombre'] . '</option>';
    }
    $tareaSelec.='</select> <br />';
    return $tareaSelec;
}
?>
<?php
$USUARIO_ADMINISTRADOR = 1;
$USUARIO_TUTOR = 2;
session_start();
if (isset($_SESSION['tipo_usuario'])) {
    if ($_SESSION['tipo_usuario'] == $USUARIO_ADMINISTRADOR ||
            $_SESSION['tipo_usuario'] == $USUARIO_TUTOR) {
        ?>
        <h1>Administracion de Plan</h1>
        
        <a href="#" id="dialog-create-link" 
           class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"
           role="button" aria-disabled="false">
                <span class="ui-button-text">Agregar plan</span></a>
        <div id="dialog-create" title="Alta de Plan">
            <div id="error"></div>
            <form action="../plan/crearPlan.php" id="dialog-create-form" method="post">
                <p>
                    Nombre <br />
                    <input type="text" id="nombre" size="41" name="nombre" placeholder="Nombre" /><br/>
                    Materiales <br /> 
                    <input type="text" id='material' name='material' placeholder="Materiales"> <br />
                    Plan Procedente <br /> 
                    <?php echo buscarPlanes(); ?>
                    Tarea <br /> 
                    <?php echo buscarTarea(); ?>
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
        $planes = $db->query(array('from' => 'plan'));

        echo '<table id="admin-table">
    <thead>
    <tr>
      <th> Nombre </th>
      <th> Fecha Creaci&oacute;n </th>
      <th> Carpeta Material </th>
      <th> Plan Procedente </th>
      <th> Tarea </th>
      <th> Opciones </th>
   </tr>
   </thead>
   <tbody>';
        $db->beginTransaction();
        foreach ($planes as $plan) {
            $tareas = $db->query(array('from' => 'tarea', 'where' => 'id_tarea=:id',
                'params' => array(':id' => $plan['tarea'])));
            $tarea = $tareas[0];
            echo '<tr>';
            addColumnTable($plan['nombre']);
            addColumnTable($plan['fecha_creacion']);
            addColumnTable($plan['carpeta_material']);
            addColumnTable($plan['plan_procedente']);
            addColumnTable($tarea['nombre']);
            addColumnTable('<a href="../plan/formUpdate.php?id=' . $plan['id_plan'] . '" class="update-option">Editar plan</a>
        <a href="../plan/delete.php?id=' . $plan['id_plan'] . '" class="delete-option">Eliminar plan</a>');
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
