<?php

include("lib.php");

$sSQL = "SELECT * FROM mensaje";

$oResult = mysql_query($sSQL);

$content= "";

$ul_inicio = "<ul>";
$ul_final = "</ul>";
$element = "";
$cont_message = 0;
$content_message = "";
$message_id = "";

if(mysql_num_rows($oResult)>0)
{
	while ($message = mysql_fetch_array($oResult))
    {
		
		if($cont_message==0)
		{
			$message_id = $message['id'];
		}
		
		$cont_message = $cont_message + 1;
		
	
		$element .= '<li><a onclick="get_messages()" href="#message'.$cont_message.'">'. utf8_encode($message['title']) .'</a></li>';
		
		$content_message .= '<div id="message'.$cont_message.'">'.utf8_encode($message['mensaje']).'</div>';
	}
}

$content = '<div id="container_message">' . $ul_inicio . $element . $ul_final . $content_message . '</div>';

$content_all = array("content"=>$content,"message_id"=>$message_id);

echo json_encode($content_all);
			
?>