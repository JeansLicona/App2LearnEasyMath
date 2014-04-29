<?php

if(isset($_POST['TxtMessage']) && $_POST['TxtMessage']!='' && !empty($_POST['TxtMessage']))
{
	include("lib.php");

	$link = connectDB();

	$message = htmlspecialchars(mysqli_real_escape_string($link,$_POST['TxtMessage']));

	$date = date_create()->format('Y-m-d H:i:s');
	
	$group = 3;

     $sql_insert = "INSERT INTO chat(mensaje,alumno,grupo,fecha)values('$message','2','$group','$date')";
        
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