<?php
session_start();

if (!isset($_SESSION['logueado']) && $_SESSION['logueado'] != 'si') {
    header('Location: ../sitio/login.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Chat</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <link href="../estilos/style.css" rel="stylesheet">
        <script type="text/javascript" src="../extensiones/jqsimplemenu/js/jqsimplemenu.js"></script>
        <link rel="stylesheet" href="../extensiones/jqsimplemenu/css/jqsimplemenu.css" type="text/css" media="screen" />	

        <script src="ckeditor/ckeditor.js"></script>
        <script src = "jquery-1.11.0.min.js" type = "text/javascript"></script>

        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui-1.10.4.custom.js"></script>


        <script type="text/javascript">

            $(document).ready(function() {

                setInterval(function() {

                    var type_chat = $("#type_chat").val();

                    if (type_chat == 'general') {

                        get_new_messages_general();

                    } else if (type_chat == 'group') {

                        get_messages_group();
                    }
                }, 3000);
                $("#ckeditor-panel").hide();
                $("#idGrupo").hide();
            });
        </script>

        <script type="text/javascript">
            $(function() {

                $("#title_chat").html("Chat General");
                $('#TxtMessage').focus();
                $("#type_chat").val('general');

                $("#see_general_chat").click(function() {

                    $("#type_chat").val('general');

                    $("#container_messages").empty();

                    $("#id_last_message").val(0);
                    $("#ckeditor-panel").hide();
                    $("#title_chat").html("Chat general");
                });
            });

            function get_new_messages_general() {

                var value_rand = (-0.5) + (Math.random() * (100.99));
                var id_last_message = $("#id_last_message").val();

                $.ajax({
                    url: 'new_messages_general.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        "id_last_message": id_last_message, "rand": value_rand
                    },
                    success: function(answer) {

                        if (answer.content != '') {
                            $("#container_messages").append(answer.content);
                            $("#id_last_message").val(answer.id_last_message);
                        }
                    },
                    /*
                     error:function(){
                     alert("Lo sentimos el servidor tiene problemas. Intente mas tarde");
                     }
                     */
                });

            }
        </script>



        <script type="text/javascript">


            function desplegarTexto(tarea) {
                var tareaElegida = tarea.value;
                $.ajax({
                    url: 'datos_tarea.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {'idTarea': tareaElegida},
                    success: function(answer) {
                        if (answer.content != '') {
                            CKEDITOR.instances.texto.setData(answer.content);
                        } else {
                            CKEDITOR.instances.texto.setData(" ");
                        }
                    }
                });
            }

            function desplegarArchivo(archivo) {
                var archivoElegido = archivo.value;
                $.ajax({
                    url: 'archivo_grupo.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {'idArchivo': archivoElegido},
                    success: function(answer) {

                        $('#archivos_grupo').dialog({
                            show: "blind",
                            hide: "explode",
                        });
                        $("#archivos_grupo").html(answer.archivo);
                    }
                });
            }

        </script>

        <script type="text/javascript">

            $(document).ready(function() {

                var value_rand = (-0.5) + (Math.random() * (100.99));

                $.ajax({
                    url: 'groups.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {'rand': value_rand},
                    success: function(answer) {

                        $("#groups").empty();
                        $("#groups").html(answer.content);
                    }
                });
            });

        </script>

        <script type="text/javascript">

            function start_messages_group(item) {
                if (item.value != 0) {
                    $("#id_group").val(item.value);
                    $("#type_chat").val('group');
                    $("#id_last_message").val(0);

                    $("#title_chat").html("Grupo");
                    $("#ckeditor-panel").show();
                    $("#container_messages").empty();
                    tareas_archivo_grupo(item.value);
                    $("#idGrupo").val(item.value);
                } else {
                    $("#type_chat").val('general');

                    $("#container_messages").empty();

                    $("#id_last_message").val(0);
                    $("#ckeditor-panel").hide();
                    $("#title_chat").html("Chat general");
                }

            }

            function get_messages_group() {

                var value_rand = (-0.5) + (Math.random() * (100.99));

                var id_group = $("#id_group").val();
                var id_last_message = $("#id_last_message").val();

                $.ajax({
                    url: 'new_messages_group.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {'rand': value_rand, 'id_group': id_group, 'id_last_message': id_last_message},
                    success: function(answer) {

                        if (answer.content != '') {
                            $("#container_messages").append(answer.content);
                            $("#id_last_message").val(answer.id_last_message);
                        }
                    }
                });
            }

            function tareas_archivo_grupo(id_grupo) {
                $.ajax({
                    url: 'archivos_grupo.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {'id_grupo': id_grupo},
                    success: function(answer) {

                        if (answer.content != '') {
                            $("#archivos_select").html(answer.archivo);
                            $("#tareas").html(answer.tarea);
                        }
                    }
                });
            }

        </script>

    </head>
    <body>

        </br>
        </br>

        <div id = "header_login">
            <img src = "../estilos/imagenes/header.png" id = "header"/>
            <hr width="100%" size="8px" color="#2D2558"/> 
        </div>

        <div id="menu-principal">
            <ul class="menu">
                <li class = "active"><a href="../sitio/index.php">Inicio</a></li> <a style = "font-size: 0px;"> | </a>
                <li><a href="../chat/logout.php">Logout</a></li>
            </ul>
        </div>
        <!-- MI CAMBIO -->
        <!-- otro cambio -->
        </br>
        </br>
        <div id = "banner-chat">
            <img src = "../estilos/imagenes/bannerChat.png" class = "banner"/>
        </div>
        <!-- fin otro cambio -->

        <input type="hidden" id="type_chat" name="type_chat" value="general" />
        <input type="hidden" id="id_group" name="id_group" value="-1" />

        <input type="hidden" id="id_last_message" name="id_last_message" value="0" />

        <div id = "chat-container">
            <div id="title_chat">
            </div>
            <div id="container_messages">
            </div>

            <div id="container_groups">
            </div>

            <input type="button" id="see_general_chat" value="Chat general"/>

            <div id="groups">
            </div>			

            <div id="div_form_message">
                <form action="save_message.php" id="form_message">
                    <p>
                        Mensaje <br />

                        <textarea type="text" id="TxtMessage" name="TxtMessage" cols="45" rows="2"  placeholder="Escriba aqu&iacute; su mensaje" required autofocus></textarea> 
                        </br>
                        </br>
                        <input type="submit" value="Enviar" class="btn btn-lg btn-primary btn-chat">
                    </p>
                </form>
            </div>

        </div>

        <div id="archivos_grupo" name="archivos_grupo">
        </div>

        <!-- CKEDITOR -->
        <br>
        <br>
        <div id = "ckeditor-panel">

            <div id = "banner-chat">
                <img src = "../estilos/imagenes/bannerPizarra.png" class = "banner"/>
            </div>
            </br>
            <h4>Subir archivos:</h4>
            <form action = "subirArchivos.php" method = "POST" enctype="multipart/form-data">  

                <label for = "imagen">Archivo: </label>
                <input type="file" name="archivo" id="archivo" class="btn btn-lg btn-primary btn-chat"/>
                <input type = "text" name="idGrupo" id="idGrupo" />

                <input type = "submit" name="subir" value="Subir">	



            </form>
            <div>Tarea:
                <div id="tareas" name="tareas" >

                </div>
            </div>

            <div>Archivo:
                <div id="archivos_select" name="archivos_select" >

                </div>
            </div>
            <textarea id="texto" name="texto" cols="" rows=""></textarea>
            <script type='text/javascript'>
                CKEDITOR.replace('texto');
                setInterval(function() {
                    var editor = CKEDITOR.instances['texto'];
                    //var value_rand = (-0.5)+(Math.randow()*(100.99));
                    var id = $("select#tarea").val();
                    //var content;

                    //CKEDITOR.instances['texto'].on('key', function() {

                        $.ajax({
                            url: 'save_content_ckeditor.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {'rand': '123', 'id': id, 'content_ckeditor': editor.getData()},
                            success: function() {
;                            }
                      //  });
                    });
                }, 3000);



            </script>

        </div>


        <script type="text/javascript">

            // Attach a submit handler to the form
            $("#form_message").submit(function(event) {

                // Stop form from submitting normally
                event.preventDefault();

                // Get some values from elements on the page:
                var $form = $(this),
                        message = $form.find("textarea[name='TxtMessage']").val(),
                        url = $form.attr("action");

                var type_chat = $("#type_chat").val();
                var id_group = $("#id_group").val();

                if ($.trim(message != '')) {

                    $.post(url,
                            {TxtMessage: message, 'TypeChat': type_chat, 'id_group': id_group},
                    function(answer) {

                        $("#TxtMessage").val('').focus();

                        $("#container_messages").append(answer.message);

                    }, 'json');
                }

            });

        </script>
    </body>
</html>
