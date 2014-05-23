<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LOGIN</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link href="../extensiones/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <link href="../estilos/style.css" rel="stylesheet">
        <script src="../extensiones/js/jquery-1.10.2.js"></script>
        <script src="../extensiones/js/jquery-ui-1.10.4.custom.js"></script>

    </head>
    <body id = "login">

        <div id = "header_login">
            <img src = "../estilos/imagenes/header.png" id = "header"/>
            <hr width="100%" size="8px" color="#2D2558"/> 
        </div>

        <div id="div_form_login">

            <form action="../validacion/validate_login.php" id="form_login">
                <h2 class="form-signin-heading"> Favor de Registrarse </h2>
                <div id="result_login"></div>
                <p>
                    <input type="text" name="TxtUserName" id="TxtUserName" class="form-control" placeholder="Usuario" required autofocus />
                    <input type="password" name="TxtPassword" id="TxtPassword" class="form-control" placeholder="Contrase&ntilde;a" required autofocus/>
                    <br />
                    <input type="submit" value="Ingresar" class="btn btn-lg btn-primary btn-block">
                </p>
            </form>
        </div>

        <script type="text/javascript">

            // Attach a submit handler to the form
            $("#form_login").submit(function(event) {

                // Stop form from submitting normally
                event.preventDefault();

                // Get some values from elements on the page:
                var $form = $(this),
                        txtUserName = $form.find("input[name='TxtUserName']").val(),
                        txtPassword = $form.find("input[name='TxtPassword']").val(),
                        url = $form.attr("action");

                $.post(url,
                        {TxtUserName: txtUserName, TxtPassword: txtPassword},
                function(answer) {

                    $("#txt_message_login").remove();

                    if (answer.status_login != 'logueado') {

                        $("#result_login").empty();
                        $("#result_login").append(answer.status_login);

                    } else if (answer.status_login == 'logueado') {

                        window.location = '../sitio/index.php';

                    }

                }, 'json');
            });

        </script>
    </body>
</html>
