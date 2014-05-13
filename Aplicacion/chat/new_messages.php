<?php

//id_last_message

//rand
//CREO QUE DEBO VALIDAR QUE SE INTEGER EL ID_LAST_MESSAGE

/*
if(isset($_GET['id_last_message']) && is_numeric($_GET['id_last_message']) &&
isset($_GET['rand']) && is_numeric($_GET['rand']) )
{
*/
include("lib.php");

$link = connectDB();
/*
$sql_messages = "SELECT mensaje.usuario_id,usuario.nombre, mensaje.mensaje,mensaje.fecha FROM mensaje join usuario on mensaje.usuario_id=usuario.id";
*/

//var_dump($_GET);die();

/*
mysqli_autocommit($con, false);

 $flag = true;  
 $sql1 = "INSERT INTO usuario ('nombre','email') VALUES ('jose','prueba1@ejemplo.com')";  
 $sql2 = "INSERT INTO usuario ('nombre','email') VALUES ('juan','prueba2@ejemplo.com')";  
 $result = mysqli_query($con, $sql1);  
 if (mysqli_errno($con)) {  
     $flag = false;  
     echo "Error: " . mysqli_error($con) . ". ";  
 }  
 $result = mysqli_query($con, $sql2);  
 if (!mysqli_errno($con)) {  
     $flag = false;  
     echo "Error: " . mysqli_error($con) . ". ";  
 }
 
 
 if ($flag) {//si no ha habido error en las consultas  
     mysqli_commit($con);  
     echo "Consultas ejecutadas correctamente";  
 } else {  
     mysqli_rollback($con);  
     echo "Todas las consultas han sido revertidas";  
 }
*/


//mysqli_free_result($result);


$sql_max_id = "SELECT MAX(id_chat) AS max_id FROM chat";

$result_max_id = mysqli_query($link,$sql_max_id);

$max_id_message = mysqli_fetch_array($result_max_id);

$max_id = 0;

$max_id = $max_id_message['max_id'];

$id_last_message_showed = $_GET['id_last_message'];

//$num_messages = 0;

$num_messages = $max_id - $id_last_message_showed;

$content = "";

if($num_messages>=0){

$sql_messages = "SELECT * FROM ";
$sql_messages .= "(SELECT * FROM chat ORDER BY id_chat DESC LIMIT $num_messages) ";
$sql_messages .= "AS messages ORDER BY id_chat ASC ";

/*
$sql_messages = "SELECT * FROM ";
$sql_messages .= "(SELECT id_mensaje,usuario,mensaje,fecha_hora FROM mensaje ORDER BY id_mensaje DESC LIMIT $num_messages) ";
$sql_messages .= "AS messages ORDER BY id_mensaje ASC ";
*/

$result = mysqli_query($link,$sql_messages);
//var_dump($sql_messages);die();
$num_rows = mysqli_num_rows($result);


//$id_last_message = "";
	
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
		
		$content .= "<div>";
		$content .= "<div>".$data_alumno."</div>";
		$content .= "<div>".$message['mensaje']."</div>";
		$content .= "<div>".$date_array[1]." ".$current_date."</div>";
		$content .= "</div>";
	}
	
//	$content .= "<div id='container_new_messages'></div>";
}else{

	$max_id = 0;
}

}

mysqli_close($link);

$all_content = array("content"=>$content,"id_last_message"=>$max_id);
	
echo json_encode($all_content);

//}
?>