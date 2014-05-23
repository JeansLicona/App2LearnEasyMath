<?php
session_start();

if (!isset($_SESSION['logueado']) && $_SESSION['logueado'] != 'si') {
    header('Location: login.php');
    exit();
}

$USUARIO_ADMINISTRADOR = 1;
$USUARIO_TUTOR = 2;
$USUARIO_ALUMNO = 3;
?>
<html>
    <head>
        <title>App2LearnEasyMath</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link href="../jquery/css/ui-darkness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <link href="../estilos/style.css" rel="stylesheet">  
        <link href="../estilos/table.css" rel="stylesheet"> 
        <script src="../jquery/js/jquery-1.10.2.js"></script>
        <script src="../jquery/js/jquery-ui-1.10.4.custom.js"></script>
        <script type="text/javascript" src="../extensiones/DataTables-1.10.0/media/js/jquery.dataTables.js"></script>

        <script type="text/javascript" src="../extensiones/jqsimplemenu/js/jqsimplemenu.js"></script>
        <link rel="stylesheet" href="../extensiones/jqsimplemenu/css/jqsimplemenu.css" type="text/css" media="screen" />
        <script type="text/javascript">
            $(document).ready(function() {
                $('.menu').jqsimplemenu();
            });

            jQuery.fn.reset = function() {
                $(this).each(function() {
                    this.reset();
                });
            }
            function unbindEvents() {
                $("#dialog-create-form").unbind('submit');
                $("#dialog-update-form").unbind('submit');
                $(".update-option").unbind('click');
                $(".delete-option").unbind('click');
                $(".add-student").unbind('click');
                $("#dialog-create-link").unbind('click');
            }
            function render(url) {
                $.get(url, function(data) {
                    if ($("#dialog-create").length) {
                        var isOpen = $("#dialog-create").dialog("isOpen");
                        if (isOpen) {
                            $("#dialog-create").dialog("close");
                        }
                        $("#dialog-create").dialog("destroy");
                    }
                    if ($("#dialog-update").length) {
                        var isOpen = $("#dialog-update").dialog("isOpen");
                        if (isOpen) {
                            $("#dialog-update").dialog("close");
                        }
                        $("#dialog-update").dialog("destroy");
                    }
                    $("#contenido").html(data);
                    if ($("#dialog-create").length && $("#dialog-create-link").length) {
                        $("#dialog-create").dialog({
                            autoOpen: false,
                            width: 340,
                        });
                        $("#dialog-create-link").click(function(event) {
                            $("#dialog-create").dialog("open");
                            event.preventDefault();
                        });
                    }
                    if ($('input.fecha').length) {
                        $('input.fecha').datepicker();
                    }
                    if ($('#dialog-create-form').length) {
                        $("#dialog-create-form").submit(function(event) {
                            event.preventDefault();
                            $.post($("#dialog-create-form").attr('action'),
                                    $("#dialog-create-form").serialize(),
                                    function(data) {
                                        if (data.status == "success") {
                                            $("#dialog-create").dialog("close");
                                            $("#dialog-create-form").reset();
                                            unbindEvents();
                                            render(url);
                                        } else {
                                            $("div#error").html("Se presentaron los siguientes errores:<br />"
                                                    + data.message);
                                        }
                                    }, "json");
                        });
                    }
                    if ($(".delete-option").length) {
                        $(".delete-option").click(function(event) {
                            event.preventDefault();
                            if (confirm("¿Estas seguro que deseas eliminar este elemento?")) {
                                $.get($(this).attr('href'),
                                        function(data) {
                                            if (data.status == "success") {
                                                unbindEvents();
                                                render(url);
                                            }
                                        }, "json");
                            }
                        });
                    }

                    if ($(".add-student").length) {
                        $(".add-student").click(function(event) {
                            event.preventDefault();
                            $.get($(this).attr('href'), function(data) {
                                if ($("#dialog-student").length) {
                                    var isOpen = $("#dialog-student").dialog("isOpen");
                                    if (isOpen) {
                                        $("#dialog-student").dialog("close");
                                    }
                                    $("#dialog-student").dialog("destroy");
                                }
                                $("#student-contenedor").html(data);
                                $("#dialog-student").dialog({
                                    autoOpen: true,
                                    width: 340,
                                });
                                $("#dialog-student-form").submit(function(event) {
                                    event.preventDefault();
                                    $.post($("#dialog-student-form").attr('action'),
                                            $("#dialog-student-form").serialize(),
                                            function(data) {
                                                if (data.status == "success") {
                                                    $("#dialog-student").dialog("close");
                                                    unbindEvents();
                                                    render(url);
                                                } else {
                                                    $("div#error-student").html(data.content);
                                                }
                                            }, "json");
                                });
                            }, "html"
                                    );
                        });
                    }

                    if ($(".update-option").length) {
                        $(".update-option").click(function(event) {
                            event.preventDefault();
                            $.get($(this).attr('href'),
                                    function(data) {
                                        if ($("#dialog-update").length) {
                                            var isOpen = $("#dialog-update").dialog("isOpen");
                                            if (isOpen) {
                                                $("#dialog-update").dialog("close");
                                            }
                                            $("#dialog-update").dialog("destroy");
                                        }
                                        $("#update-contenedor").html(data);
                                        $("#dialog-update").dialog({
                                            autoOpen: true,
                                            width: 340,
                                        });
                                        $("#dialog-update-form").submit(function(event) {
                                            event.preventDefault();
                                            $.post($("#dialog-update-form").attr('action'),
                                                    $("#dialog-update-form").serialize(),
                                                    function(data) {
                                                        if (data.status == "success") {
                                                            $("#dialog-update").dialog("close");
                                                            unbindEvents();
                                                            render(url);
                                                        } else {
                                                            if (data.status == "error") {
                                                                $("div#error-update").html("Se presentaron los siguientes errores:<br />"
                                                                        + data.message);
                                                            }
                                                        }
                                                    }, "json");
                                        });
                                    }, "html");
                        });
                    }
                    if ($('table#admin-table').length) {
                        $('table#admin-table').dataTable({
                            "sScrollY": "200px",
                            "bPaginate": false,
                            "language": {
                                "emptyTable": "No hay datos disponibles",
                                "info": "Mostrar _INICIO_ AL _FIN_ del _TOTAL_ entradas",
                                "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                                "infoFiltered": "(Filtrar del _MAX_ total de entradas)",
                                "infoPostFix": "",
                                "thousands": ",",
                                "lengthMenu": "Mpstra _MENU_ entradas",
                                "loadingRecords": "Cargando...",
                                "processing": "Procesando...",
                                "search": "Busqueda:",
                                "zeroRecords": "No se encontraron resultados",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Ultimo",
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                },
                                "aria": {
                                    "sortAscending": ": activar para ordenar columnas de manera acendente",
                                    "sortDescending": ": activar para ordenar columnas de manera descendente"
                                }
                            }
                        });
                    }
                }, "html");
            }
        </script>
        <style type="text/css">

        </style>
    </head>
    <body>

        </br>
        </br>

        <div id = "header_login">
            <img src = "../estilos/imagenes/header.png" id = "header"/>
            <hr width="100%" size="8px" color="#2D2558"/> 
        </div>
        <div id="menu-principal">
            <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == $USUARIO_ADMINISTRADOR) { ?>
                <ul class="menu">
                    <li class = "active"><a href="#">Inicio</a></li> <a style = "font-size: 0px;"> | </a>
                    <li><a href="#">Administracion</a>
                        <ul>
                            <li><a href="#" onclick="render('../alumno/admin.php');">Alumnos</a>
                            </li>
                            <li><a href="#" onclick="render('../tutor/admin.php');">Tutores</a></li>
                        </ul>
                    </li>
                    <li><a href="#" onclick="render('../plan/admin.php');">Plan</a></li>
                    <li><a href="#" onclick="render('../tarea/admin.php');">Tarea</a></li>
                    <li><a href="#" onclick="render('../grupo/admin.php');">Grupo</a></li>	
                    <li><a href="../chat/index.php">Chat</a></li> 
                    <li><a href="../chat/logout.php">Logout</a></li>
                </ul>
                <?php
            } else {
                if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == $USUARIO_TUTOR) {
                    ?>
                    <ul class="menu">
                        <li class = "active"><a href="#">Inicio</a></li> <a style = "font-size: 0px;"> | </a>
                        <li><a href="#" onclick="render('../plan/admin.php');">Plan</a></li>
                        <li><a href="#" onclick="render('../tarea/admin.php');">Tarea</a></li>
                        <li><a href="#" onclick="render('../grupo/admin.php');">Grupo</a></li>
                        <li><a href="../chat/index.php">Chat</a></li> 
                        <li><a href="../chat/logout.php">Logout</a></li>
                    </ul>
                    <?php
                } else {
                    if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == $USUARIO_ALUMNO) {
                        ?>
                        <ul class="menu">
                            <li class = "active"><a href="#">Inicio</a></li> <a style = "font-size: 0px;"> | </a>
                            <li><a href="../chat/index.php">Chat</a></li> 
                            <li><a href="../chat/logout.php">Logout</a></li>
                        </ul>
                        <?php
                    }
                }
            }
            ?>

        </div>

        <div id="contenido">

        </div>
    </body>
</html>