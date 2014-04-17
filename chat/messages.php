<?php
include("lib.php");

$link = connectDB();

$num_messages = 20;

$sql_max_id = "SELECT MAX(id_mensaje) AS max_id FROM mensaje";

$sql_messages = "SELECT * FROM ";
$sql_messages .= "(SELECT id_mensaje,usuario,mensaje,fecha_hora FROM mensaje ORDER BY id_mensaje DESC LIMIT $num_messages) ";
$sql_messages .= "AS messages ORDER BY id_mensaje ASC ";

$result = mysqli_query($link,$sql_messages);

$num_rows = mysqli_num_rows($result);

$content = "";

if($num_rows>0)
{
	while ($message = mysqli_fetch_array($result))
    {
	
		$date_array = explode(" ",$message['fecha_hora']);
		$current_date_array = explode("-",$date_array[0]);
		$current_date = $current_date_array[2]."/".$current_date_array[1]."/".$current_date_array[0];
		
		$content .= "<div>".$message['usuario']."</div>";
		$content .= "<div>".$message['mensaje']."</div>";
		$content .= "<div>".$date_array[1]." ".$current_date."</div>";
	}
}

mysqli_close($link);

$all_content = array("content"=>$content);
	
echo json_encode($all_content);

?>