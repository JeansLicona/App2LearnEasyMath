<?php
    include_once '../util/ComandosBD.php';

    function buscarTutor() {
        $responsableSelec = "";
        $query = new ComandosBD();
        $tutores = $query->query(array('from' => 'tutor'));
        $responsableSelec.='<select id="tutor" name="tutor" placeholder="Tutor">';
        foreach ($tutores as $tutor) {
            $nombre = $tutor['nombres'] . " " . $tutor['apellidos'];
            $responsableSelec.='<option value="' . $tutor['id_tutor'] . '">' . $nombre . '</option>';
        }
        $responsableSelec.='</select> <br />';
        return $responsableSelec;
    }

    function buscarPlanes() {
        $planSelec = "";
        $query = new ComandosBD();
        $planesEle = $query->query(array('from' => 'plan'));
        $planSelec.='<select id="plan" name="plan" placeholder="Plan">';
        foreach ($planesEle as $plan) {
            $planSelec.='<option value="' . $plan['id_plan'] . '">' . $plan['nombre'] . '</option>';
        }
        $planSelec.='</select> <br />';
        return $planSelec;
    }
?>

<h1>Administracion de Grupo</h1>
<p><a href="#" id="dialog-create-link" class="ui-state-default ui-corner-all">
        <span class="ui-icon ui-icon-newwin"></span>Agregar grupo</a></p>
<div id="dialog-create" title="Alta de Grupo">
    <div id="error"></div>
    <form action="../grupo/crearGrupo.php" id="dialog-create-form" method="post">
        <p>
            Nombre <br />
            <input type="text" id="nombre" size="41" name="nombre" placeholder="Nombre" /><br/>
            Fecha desintegraci&oacute;n <br /> 
            <input type="text" id='fecha_fin' name='fecha_fin' placeholder="Fecha Desintegración" class="fecha"> <br />
            Tutor <br /> 
            <?php echo buscarTutor();
            ?>
            Plan Procedente <br /> 
            <?php echo buscarPlanes(); ?>
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
    $grupos = $db->query(array('from' => 'grupo'));

    echo '<table id="admin-table">
    <thead>
    <tr>
      <th> Nombre </th>
      <th> Fecha Creaci&oacute;n </th>
      <th> Responsable </th>
      <th> Plan </th>
      <th> Opciones </th>
   </tr>
   </thead>
   <tbody>';
    $db->beginTransaction();
    foreach ($grupos as $grupo) {
        $planes = $db->query(array('from' => 'plan', 'where' => 'id_plan=:id',
            'params' => array(':id' => $grupo['plan'])));
        $plan = $planes[0];
        $responsables = $db->query(array('from' => 'tutor', 'where' => 'id_tutor=:id',
            'params' => array(':id' => $grupo['tutor'])));
        $responsable = $responsables[0];
        echo '<tr>';
        addColumnTable($grupo['nombre']);
        addColumnTable($grupo['fecha_creacion']);
        addColumnTable($responsable['apellidos'] . " " . $responsable['nombres']);
        addColumnTable($plan['nombre']);
        addColumnTable('<a href="../grupo/formUpdate.php?id=' . $grupo['id_grupo'] . '" class="update-option">Editar grupo</a>
        <a href="../grupo/delete.php?id=' . $grupo['id_grupo'] . '" class="delete-option">Eliminar grupo</a>
             <a href="../grupo/formClase.php?id=' . $grupo['id_grupo'] . '">Añadir Integrantes</a>'
        );
        echo '</tr>';
    }
    echo '
    </tbody>
    </table>';


    