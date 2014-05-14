<?php
	include("../validacion/lib.php");

	$link = connectDB();
	
    $txtUserName = mysqli_real_escape_string($link,$_POST["TxtUserName"]);
    $txtPassword = mysqli_real_escape_string($link,$_POST["TxtPassword"]);

	$status_login = "";
	
	if(!trim($txtUserName)=='' && !trim($txtPassword)=='')
	{

	$sql_name_user = "SELECT id_usuario,tipo_usuario,contrasena FROM usuario WHERE nombre_usuario='$txtUserName' LIMIT 1";
	
	$result_user = mysqli_query($link,$sql_name_user);
	
	if(mysqli_num_rows($result_user)==1)
	{
	$modelo = mysqli_fetch_array($result_user);
	
	if(crypt($txtPassword,$modelo['contrasena']) == $modelo['contrasena'])
	{
	 
	 $user_type = $modelo['tipo_usuario'];
	
	$table = "";
	
	if($user_type=='1')
	{
		session_start();
		$_SESSION['id_usuario'] = $modelo['id_usuario'];
        $_SESSION['nombre_usuario'] = $txtUserName;
		$_SESSION['tipo_usuario'] = $user_type;
		$_SESSION['logueado'] = "si";
        $status_login = 'logueado';
	}
	else if($user_type=='2' || $user_type=='3')
	{
	
	if($user_type=='2')
	{
		$table = "tutor";
		
	}else if($user_type='3')
	{
		$table = "alumno";
	}
	
	if($table!="" && $user_type!="")
	{
		$sql_info = "SELECT nombres,apellidos FROM $table WHERE usuario='$user_type' LIMIT 1";
		//echo $sql_info;die();
		$result_info = mysqli_query($link,$sql_info);
		
		if(mysqli_num_rows($result_info)==1)
		{
		
		$info = mysqli_fetch_array($result_info);
	
        session_start();
        $_SESSION['id_usuario'] = $modelo['id_usuario'];
        $_SESSION['nombre_usuario'] = $txtUserName;
		$_SESSION['nombres'] = $info['nombres'];
		$_SESSION['apellidos'] = $info['apellidos'];
		$_SESSION['tipo_usuario'] = $user_type;
		$_SESSION['logueado'] = "si";
        $status_login = 'logueado';	
	}
	
	}
	
	}
	}else
	{
	    $status_login = "<p>Usuario o contrase&ntilde;a incorrecta.</p>";
	}
	
	}else
    {
		$status_login = "<p>Usuario o contrase&ntilde;a incorrecta.</p>";
    }
	
	}else{
		if (trim($txtUserName)=='')
		{
			$status_login .= "<p>El usuario es obligatorio.</p>";
		}
		
		if (trim($txtPassword)=='')
		{
			$status_login .= "<p>La contrase&ntilde;a es obligatoria.</p>";
		}
	
	}
	
	//mysqli_free_result($oResult);
    mysqli_close($link);
	
	$array = array("status_login"=>$status_login);
	echo json_encode($array);
?>