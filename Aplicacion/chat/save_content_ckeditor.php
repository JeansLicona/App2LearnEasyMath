<?php

session_start();

if(!isset($_SESSION['logueado']) && $_SESSION['logueado']!='si')
{
	header('Location: ../sitio/login.php');
	exit();
}

if(isset($_POST['rand']) && trim($_POST['rand'])!='' && 
isset($_POST['id']) && !empty($_POST['id']) && trim($_POST['id'])!='' && 
isset($_POST['content_ckeditor']) )
{
	include("../validacion/lib.php");

	$link = connectDB();

	$message = htmlspecialchars(mysqli_real_escape_string($link,$_POST['content_ckeditor']));

	$content = $_POST['content_ckeditor'];
	//$id_tarea = $_POST['id'];
	$id_tarea = $_POST['id'];
	
	$sql_update = "UPDATE tarea SET contenido='$content' WHERE id_tarea='$id_tarea'";
	
    if($result = mysqli_query($link,$sql_update)) 
	{
		$all_content = array("message"=>"<div> Fco: ".$message."<br /></div>");

     } else {
        
		$all_content = array("message"=>"<div>(mensaje no enviado)</div>");
    }
    
    //mysqli_free_result($result);
	mysqli_close($link);
	
	echo json_encode($all_content);
}
?>