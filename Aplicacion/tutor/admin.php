
<h1>Administracion de Tutor</h1>
<p><a href="#" id="dialog-create-link" class="ui-state-default ui-corner-all">
        <span class="ui-icon ui-icon-newwin"></span>Agregar tutor</a></p>
<div id="dialog-create" title="Alta de Tutor">
    <div id="error"></div>
    <form action="../tutor/crearTutor.php" id="dialog-create-form" method="post">
        <p>
            Nombres <br />
            <input type="text" id="nombres" size="41" name="nombres" placeholder="Nombres" /><br/>
            Apellidos <br />
            <input type="text" id="apellidos" size="41" name="apellidos" placeholder="Apellidos" /><br/>
            Secci&oacute;n <br />
            <input type="text" id="seccion" size="41" name="seccion" placeholder="Sección" /><br/>
            Fecha de nacimiento: <br /> 
            <input type="text" id='fecha_nacimiento' name='fecha_nacimiento' placeholder="Fecha de nacimiento" class="fecha"> <br />
            Correo <br /> 
            <input type="text" id="correo" size="41" name="correo" placeholder="Correo" /><br/>
            Contraseña <br />
            <input type="password" id="contraseña" size="41" name="contrasena" placeholder="Contraseña" /><br/>
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

    include_once '../util/ComandosBD.php';
    $db = new ComandosBD();
    $tutores = $db->query(array('from' => 'tutor'));
    echo '<table id="admin-table">
    <thead>
    <tr>
      <th> Nombre </th>
      <th> Secci&oacute;n </th>
      <th> Fecha nacimiento </th>
      <th> Fecha ingreso </th>
      <th> Correo </th>
      <th> Opciones </th>
   </tr>
   </thead>
   <tbody>';
    foreach ($tutores as $tutor) {
        echo '<tr>';
        addColumnTable($tutor['apellidos'] . " " . $tutor['nombres']);
        addColumnTable($tutor['seccion']);
        addColumnTable($tutor['fecha_nacimiento']);
        addColumnTable($tutor['fecha_ingreso']);
        addColumnTable($tutor['correo']);
        addColumnTable('<a href="../tutor/formUpdate.php?id=' . $tutor['id_tutor'] . '" class="update-option">Editar tutor</a>
        <a href="../tutor/delete.php?id=' . $tutor['id_tutor'] . '" class="delete-option">Eliminar tutor</a>');
        echo '</tr>';
    }
    echo '
    </tbody>
    </table>';
?>