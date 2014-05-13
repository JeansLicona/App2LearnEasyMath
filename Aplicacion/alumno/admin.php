

<h1>Administracion de alumnos</h1>
<p><a href="#" id="dialog-create-link" class="ui-state-default ui-corner-all">
        <span class="ui-icon ui-icon-newwin"></span>Agregar alumno</a></p>
<div id="dialog-create" title="Alta de alumno">
    <div id="error"></div>
    <form action="../alumno/crearAlumno.php" id="dialog-create-form" method="post">
        <p>
            Nombres <br />
            <input type="text" id="nombres" size="41" name="nombres" placeholder="Nombres" /><br/>
            Apellidos <br />
            <input type="text" id="apellidos" size="41" name="apellidos" placeholder="Apellidos" /><br/>
            Matricula <br />
            <input type="text" id="matricula" size="41" name="matricula" placeholder="Matricula" /><br/>
            Institucion <br />
            <input type="text" id="institucion" size="41" name="institucion" placeholder="Institucion" /><br/>
            Contraseña <br />
            <input type="password" id="contraseña" size="41" name="contrasena" placeholder="Contraseña" /><br/>
            Confirmar Contraseña <br />
            <input type="password" id="confirmPassword" size="41" name="confirmPassword" placeholder="Confirmar contraseña" /><br/>
            Fecha de nacimiento <br /> 
            <input type="text" id='fecha_nacimiento' name='fecha_nacimiento' placeholder="Fecha de nacimiento" class="fecha"> <br />
            Correo <br /> 
            <input type="text" id="correo" size="41" name="correo" placeholder="Correo" /><br/>
            Informacion adicional <br />
            <textarea type="text" id="informacion_adicional" name="informacion_adicional" cols="40" rows="2" placeholder="Informacion adicional..." ></textarea>
            <input type="submit" value="Save">
        </p>
    </form>
</div>
<div id="update-contenedor">
</div>

<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function addColumnTable($data) {
    echo '<td>';
    echo $data;
    echo '</td>';
}

include_once '../util/ComandosBD.php';
$db = new ComandosBD();
$alumnos = $db->query(array('from' => 'alumno'));
echo '<table id="admin-table">
    <thead>
    <tr>
      <th> Nombre </th>
      <th> Institucion </th>
      <th> Matricula </th>
      <th> Correo </th>
      <th> Opciones </th>
   </tr>
   </thead>
   <tbody>';
foreach ($alumnos as $alumno) {
    echo '<tr>';
    addColumnTable($alumno['apellidos'] . " " . $alumno['nombres']);
    addColumnTable($alumno['institucion']);
    addColumnTable($alumno['matricula']);
    addColumnTable($alumno['correo']);
    addColumnTable('<a href="../alumno/formUpdate.php?id=' . $alumno['id_alumno'] . '" class="update-option">Editar alumno</a>
        <a href="../alumno/delete.php?id=' . $alumno['id_alumno'] . '" class="delete-option">Eliminar alumno</a>');
    echo '</tr>';
}
echo '
    </tbody>
    </table>';
?>