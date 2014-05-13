<?php

	include("lib.php");

	$link = connectDB();
	
    $txtUserName = mysqli_real_escape_string($link,$_POST["TxtUserName"]);
    $txtPassword = mysqli_real_escape_string($link,$_POST["TxtPassword"]);

	
    $sql_user = "SELECT id_usuario,tipo_usuario FROM usuario WHERE nombre_usuario='$txtUserName' AND contrasena='$txtPassword' LIMIT 1";

    $oResult = mysqli_query($link,$sql_user);
            
    $modelo = mysqli_fetch_array($oResult);
	
	//mysqli_free_result($oResult);
    mysqli_close($link);

	$status_login = "";
	
    if(!empty($modelo))
    {
        session_start();
        $_SESSION['id_usuario'] = $modelo['id_usuario'];
        $_SESSION['nombre_usuario'] = $txtUserName;
		$_SESSION['tipo_usuario'] = $modelo['tipo_usuario'];
		$_SESSION['logueado'] = "si";
        $status_login = 'logueado';

    }else
    {
        $status_login = "<div id='txt_message_login'>Usuario o contrase&ntilde;a incorrecta</div>";
    }     
	
	$array = array("status_login"=>$status_login);
	echo json_encode($array);
?>