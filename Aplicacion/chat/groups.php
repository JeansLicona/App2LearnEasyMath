<?php

    session_start();

    if (!isset($_SESSION['logueado']) && $_SESSION['logueado'] != 'si' &&
            isset($_SESSION['id_usuario']) && isset($_SESSION['tipo_usuario']) && is_numeric($_SESSION['tipo_usuario'])) {
        header('Location: ../sitio/login.php');
        exit();
    }

    if (isset($_GET['rand']) && !empty($_GET['rand']) && is_numeric($_GET['rand'])) {
        include("../validacion/lib.php");

        $link = connectDB();

        $content = '<select id="select_group" onchange="start_messages_group(this)">';
        $content .= '<option>Seleccionar grupo</option>';

        if ($_SESSION['tipo_usuario'] == 1) {

            $sql_name_group = "SELECT id_grupo,nombre FROM grupo ";

            $result_name_group = mysqli_query($link, $sql_name_group);

            if (mysqli_num_rows($result_name_group) > 0) {
                while ($group = mysqli_fetch_array($result_name_group)) {

                    $name = $group['nombre'];
                    $id_group = $group['id_grupo'];

                    $content .= '<option value="' . $id_group . '" >' . $name . '</option>';
                }
                $content .= '</select>';
            } else {

                $content = '';
            }
        } else {

            $user_id = $_SESSION['id_usuario'];


            $sql_user_group = "SELECT grupo_id FROM usuario_grupo WHERE usuario_id='$user_id'";

            $result_user_group = mysqli_query($link, $sql_user_group);



            if (mysqli_num_rows($result_user_group) > 0) {
                while ($group = mysqli_fetch_array($result_user_group)) {
                    $id_group = $group['grupo_id'];

                    $sql_name_group = "SELECT nombre FROM grupo WHERE id_grupo='$id_group' LIMIT 1";

                    $result_name_group = mysqli_query($link, $sql_name_group);

                    if (mysqli_num_rows($result_name_group) == 1) {
                        $name_group = mysqli_fetch_array($result_name_group);

                        $name = $name_group['nombre'];

                        $content .= '<option onclick="start_messages_group(this)" value="' . $id_group . '" >' . $name . '</option>';
                    }
                }

                $content .='</select>';
            } else {
                $content = '';
            }
        }



        $all_content = array("content" => $content);

        echo json_encode($all_content);
    }
?>