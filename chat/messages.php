<?php

include("lib.php");

$link = connectDB();
/*
$sql_messages = "SELECT mensaje.usuario_id,usuario.nombre, mensaje.mensaje,mensaje.fecha FROM mensaje join usuario on mensaje.usuario_id=usuario.id";
*/

//$sql_messages = "SELECT id_chat,usuario,mensaje,fecha_hora FROM mensaje LIMIT 20";

$num_messages = 20;

//$sql_max_id = "SELECT MAX(id_chat) AS max_id FROM mensaje";

$sql_messages = "SELECT * FROM ";
$sql_messages .= "(SELECT * FROM chat ORDER BY id_chat DESC LIMIT $num_messages) ";
$sql_messages .= "AS messages ORDER BY id_chat ASC ";

$result = mysqli_query($link,$sql_messages);

$num_rows = mysqli_num_rows($result);

$content = "";
$id_last_message = 0;

if($num_rows>0)
{
	while ($message = mysqli_fetch_array($result))
    {
		$id_last_message = $message['id_chat'];
	
		$date_array = explode(" ",$message['fecha']);
		$current_date_array = explode("-",$date_array[0]);
		$current_date = $current_date_array[2]."/".$current_date_array[1]."/".$current_date_array[0];
		
		$id_alumno = $message['alumno'];
		
		$sql_get_alumno = 'SELECT nombres,apellidos FROM alumno WHERE id_alumno='.$id_alumno.' LIMIT 1' ;
		
		$result_alumno = mysqli_query($link,$sql_get_alumno);
		
		$num_row_alumno = mysqli_num_rows($result_alumno);
		
		$data_alumno = '';
		
		if($num_row_alumno==1)
		{
			$alumno = mysqli_fetch_array($result_alumno);
			$name = $alumno['nombres'];
			$last_name = $alumno['apellidos'];
			
			$data_alumno = $name.' '.$last_name;
		}
		
		$content .= "<div>".$data_alumno."</div>";
		$content .= "<div>".$message['mensaje']."</div>";
		$content .= "<div>".$date_array[1]." ".$current_date."</div>";
	}
	//$content .= "<div id='container_new_messages'></div>";
}

mysqli_close($link);

$all_content = array("content"=>$content,'id_last_message'=>$id_last_message);
	
echo json_encode($all_content);

?>