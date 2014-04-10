<?php

include("lib.php");

/*
$sSQL = "SELECT mensaje.usuario_id,usuario.nombre, mensaje.mensaje,mensaje.fecha FROM mensaje join usuario on mensaje.usuario_id=usuario.id";
*/

$sSQL = "SELECT * FROM mensaje";

$oResult = mysql_query($sSQL);

$num_rows = mysql_num_rows($oResult);

$content = "";
	
if($num_rows>0)
{
	while ($message = mysql_fetch_array($oResult))
    {
	
		$content .= "<div>".$message['usuario_id']."</div>";
		$content .= "<div>".$message['mensaje']."</div>";
		$content .= "<div>".$message['fecha']."</div>";
	}
}

	$all_content = array("content"=>$content);
	
echo json_encode($all_content);


?>