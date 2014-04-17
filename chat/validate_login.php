<?php
    
    $txtUserName = mysql_real_escape_string($_POST["TxtUserName"]);
    $txtPassword = mysql_real_escape_string($_POST["TxtPassword"]);

	include("lib.php");
	
    $sql_user = "SELECT id_usuario FROM usuario WHERE nombre_usuario='$txtUserName' AND contrasena='$txtPassword' ";

    $oResult = mysql_query($sql_user);
            
    $modelo = mysql_fetch_array($oResult);
	
	mysql_free_result($oResult);
    mysql_close($oLink);

	$status_login = "";
	
    if(!empty($modelo))
    {
        session_start();
        $_SESSION['id_usuario'] = $modelo['id_usuario'];
        $_SESSION['nombre_usuario'] = $modelo['nombre_usuario'];
		$_SESSION['logueado'] = "si";
        $status_login = 'logueado';
		
		//	FALTA REDIRECCIONAR A INDEX.PHP DESPUES DE HABERSE LOGUEADO
		//header('Location: ./index.php');

    }else
    {
        $status_login = "<div id='txt_message_login'>Usuario o contrase&ntilde;a incorrecta</div>";
    }     
	
	$array = array("status_login"=>$status_login);
	echo json_encode($array);
?>