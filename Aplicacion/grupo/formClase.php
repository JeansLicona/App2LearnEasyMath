<?php
    include_once '../util/ComandosBD.php';

    function buscarAlumnos() {
        $query = new ComandosBD();
        $alumnos = $query->query(array('from' => 'alumno'));
        $alumnoSelec = '<select id="alumno" name="alumno" placeholder="Alumno">';
        foreach ($alumnos as $alumno) {
            $nombre = $alumno['nombres'] . " " . $alumno['apellidos'];
            $alumnoSelec.='<option value="' . $alumno['id_alumno'] . '">' . $nombre . '</option>';
        }
        $alumnoSelec.='</select> <br />';
        return $alumnoSelec;
    }

    if (isset($_GET['id'])) {
        $comandosBD = new ComandosBD();
        $grupos = $comandosBD->query(array('from' => 'grupo', 'where' => 'id_grupo=:id',
            'params' => array(':id' => $_GET['id'])));
        $grupo = $grupos[0];
        ?>
        <div id="dialog-student" title="Añadir Estudiante a <?php echo $grupo['nombre']; ?>">
            <div id="error-student"></div>
            <form action="../grupo/clase.php?id=<?php echo $_GET['id'] ?>" id="dialog-student-form" method="post">
                <p>
                    Estudiante <br />
                    <?php echo buscarAlumnos(); ?>
                    <input type="submit" value="Guardar">
                </p>
            </form>
        </div>
        <?php
    }
?>
