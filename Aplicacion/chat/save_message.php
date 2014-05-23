<?php

session_start();

if(!isset($_SESSION['logueado']) && $_SESSION['logueado']!='si')
{
	header('Location: ../sitio/login.php');
	exit();
}


if(isset($_POST['TxtMessage']) && $_POST['TxtMessage']!='' && 
!empty($_POST['TxtMessage']) && trim($_POST['TxtMessage'])!='' &&
!empty($_POST['id_group']) && trim($_POST['id_group'])!='' &&
!empty($_POST['TypeChat']) && trim($_POST['TypeChat'])!='' &&
($_POST['TypeChat']=='general' || $_POST['TypeChat']=='group') &&
$_SESSION['id_usuario'] && is_numeric($_SESSION['id_usuario']) )
{
	include("../validacion/lib.php");

	$link = connectDB();

	$message = htmlspecialchars(mysqli_real_escape_string($link,$_POST['TxtMessage']));

	$date = date_create()->format('Y-m-d H:i:s');
	
	
	$id_user = $_SESSION['id_usuario'];
	
	$type_chat = $_POST['TypeChat'];
	
	if($type_chat=='general')
	{
		$sql_insert = "INSERT INTO chat_general(mensaje,usuario_id,fecha)values('$message','$id_user','$date')";
		
	}else if($type_chat=='group')
	{
		$id_group = $_POST['id_group'];
		
		$sql_insert = "INSERT INTO chat_grupo(mensaje,usuario_id,grupo_id,fecha)values('$message','$id_user','$id_group','$date')";
	}

	$all_content = "";
		
	$date_array = explode(" ",$date);
	$current_date_array = explode("-",$date_array[0]);
		
	$current_date = $current_date_array[2]."/".$current_date_array[1]."/".$current_date_array[0];
		
    if($result = mysqli_query($link,$sql_insert)) 
	{
		//$all_content = array("message"=>"<div> Fco: ".$message."<br />".$date_array[1]." ". $current_date ."</div>");

     } else {
        
		$all_content = array("message"=>"<div>".$message." " .$date_array[1]." ".$current_date." (mensaje no enviado)</div>");
    }
    
    //mysqli_free_result($result);
	mysqli_close($link);
	
	echo json_encode($all_content);
}
?>