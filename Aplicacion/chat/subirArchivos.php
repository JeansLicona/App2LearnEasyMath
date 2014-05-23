<?php

    include '../util/ComandosBD.php';


    if ($_FILES["archivo"]["error"] > 0) {
        echo "ha ocurrido un error";
    } else {
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png", "document/pdf");
        $limite_kb = 100;

        if (in_array($_FILES['archivo']['type'], $permitidos) && $_FILES['archivo']['size'] <= $limite_kb * 1024) {
            $comandoUtil = new ComandosBD();

            $ruta = "../uploads/" . $_FILES['archivo']['name'];

            if (!file_exists($ruta)) {

                $resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
                if ($resultado) {

                    $nombre = $_FILES['archivo']['name'];
                    $tipo = $_FILES['archivo']['type'];
                    $grupo = $_POST['idGrupo'];

                    $ext = explode(".", $tipo);
                    $extension = $ext[0];

                    if ($extension == 'pdf' || $extension == 'PDF') {
                        $tipoArchivo = 1;
                    }
                    else
                        $tipoArchivo = 2;

                    $comandoUtil->insert("archivo", array(
                        'nombre' => $nombre,
                        'url' => $ruta,
                        'tipo_archivo' => $tipoArchivo,
                        'grupo' => $grupo,
                    ));
                     header('Location: ../chat/index.php');
                } else {
                    echo "ocurrio un error al mover el archivo.";
                    header('Location: ../chat/index.php');
                }
            } else {
                echo $_FILES['archivo']['name'] . ", este archivo existe";
                header('Location: ../chat/index.php');
            }
        } else {
            echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
            header('Location: ../chat/index.php');
        }
    }
?>
