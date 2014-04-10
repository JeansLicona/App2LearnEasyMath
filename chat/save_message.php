<?php

$message = $_POST['TxtMessage'];
//$date = date("Y-m-d");
$date = date_create()->format('Y-m-d H:i:s');

//var_dump($_POST);
//die();
include("lib.php");

     $sSQL = "INSERT INTO mensaje(usuario_id,mensaje,fecha)values('1','$message','$date')";
        
		$content_all = "";
		
		$date_array = explode(" ",$date);
		$current_date_array = explode("-",$date_array[0]);
		
		$current_date = $current_date_array[2]."/". $current_date_array[1] . "/" .$current_date_array[0];
		
    if($oResult = mysql_query($sSQL)) {
        //$sStatus = "Added successful";
		$content_all = array("message"=>"<div> Fco: ".$message."<br />".$date_array[1]." ". $current_date ."</div>");

		
     } else {
        //$sStatus = "An error occurred while inserting; customer not saved.";
		$content_all = array("message"=>"<div>".$message." " .$date." (mensaje no enviado)</div>");
    }
    
    //mysql_free_result($oResult);
    mysql_close($oLink);
	
	echo json_encode($content_all);
	
?>