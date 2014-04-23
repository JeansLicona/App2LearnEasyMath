<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link href="../jquery/css/ui-darkness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <script src="../jquery/js/jquery-1.10.2.js"></script>
        <script src="../jquery/js/jquery-ui-1.10.4.custom.js"></script>
        <script type="text/javascript" src="../extensiones/DataTables-1.8.0/media/js/jquery.dataTables.js"></script>

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
                $("#dialog-create-link").unbind('click');
            }
            function render(url) {
                $.get(url, function(data) {
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
                                            $("div#error").html(data.content);
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
                                            } else {
                                                alert(data.content);
                                            }
                                        }, "json");
                            }
                        });
                    }
                    if ($(".update-option").length) {
                        $(".update-option").click(function(event) {
                            event.preventDefault();
                            $.get($(this).attr('href'),
                                    function(data) {
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
                                                            $("div#error-update").html(data.content);
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
                        });
                    }
                }, "html");
            }
        </script>
        <style type="text/css">
            div#contenido { 
                clear:both; 
            }
            body{
                font: 82.5% "Trebuchet MS", sans-serif;
                margin: 50px;
            }

            #dialog-link {
                padding: .4em 1em .4em 20px;
                text-decoration: none;
                position: relative;
            }
            #dialog-link span.ui-icon {
                margin: 0 5px 0 0;
                position: absolute;
                left: .2em;
                top: 50%;
                margin-top: -8px;
            }
            #icons {
                margin: 0;
                padding: 0;
            }
            #icons li {
                margin: 2px;
                position: relative;
                padding: 4px 0;
                cursor: pointer;
                float: left;
                list-style: none;
            }
            #icons span.ui-icon {
                float: left;
                margin: 0 4px;
            }
            .fakewindowcontain .ui-widget-overlay {
                position: absolute;
            }
            #error{
                color: red;
                background-color: #F08080;
            }
        </style>
    </head>
    <body>
        <div id="menu-principal">
            <ul class="menu">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Administracion</a>
                    <ul>
                        <li><a href="#" onclick="render('../alumno/admin.php');">Alumnos</a>
                        </li>
                        <li><a href="#">Tutores</a></li>
                    </ul>
                </li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Acerca de</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        <div id="contenido">

        </div>
    </body>
</html>