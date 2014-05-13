<?php

if(isset($_GET['id_last_message']) && is_numeric($_GET['id_last_message']) &&
isset($_GET['rand']) && is_numeric($_GET['rand']) )
{

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


$sql_max_id = "SELECT MAX(id_chat) AS max_id FROM chat_general";

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
$sql_messages .= "(SELECT * FROM chat_general ORDER BY id_chat DESC LIMIT $num_messages) ";
$sql_messages .= "AS messages ORDER BY id_chat ASC ";

$result = mysqli_query($link,$sql_messages);

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
		
		$id_user = $message['usuario_id'];
		
		$sql_get_user = 'SELECT tipo_usuario FROM usuario WHERE id_usuario='.$id_user.' LIMIT 1';
		
		$result_user = mysqli_query($link,$sql_get_user);
		
		$num_row_user = mysqli_num_rows($result_user);
		
		$data_user = '';
		$table = '';
		
		
		if($num_row_user==1)
		{
			
			$result_user_type = mysqli_fetch_array($result_user);
		
			$user_type = $result_user_type['tipo_usuario'];
			
			if($user_type=='1')
			{
			
			$data_user = 'admin';
			
			$content .= "<div>";
			$content .= "<div>".$data_user."</div>";
			$content .= "<div>".$message['mensaje']."</div>";
			$content .= "<div>".$date_array[1]." ".$current_date."</div>";
			$content .= "</div>";
			}else if($user_type=='2' || $user_type=='3')
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
		$sql_info = "SELECT nombres,apellidos FROM $table WHERE usuario='$id_user' LIMIT 1";
		
		$result_info = mysqli_query($link,$sql_info);
		
		if(mysqli_num_rows($result_info)==1)
		{
		
		$info = mysqli_fetch_array($result_info);
		
		$content .= "<div>";
			$content .= "<div>".$info['nombres'].' '.$info['apellidos']."</div>";
			$content .= "<div>".$message['mensaje']."</div>";
			$content .= "<div>".$date_array[1]." ".$current_date."</div>";
			$content .= "</div>";
			
	}
	
	}
	
	}
		
		}
		
		
	}
	
//	$content .= "<div id='container_new_messages'></div>";
}else{

	$max_id = 0;
}

}

mysqli_close($link);

$all_content = array("content"=>$content,"id_last_message"=>$max_id);
	
echo json_encode($all_content);

}
?>