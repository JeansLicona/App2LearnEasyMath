<?php
include("lib.php");

$date_form = $_GET['date'];

$date_array = explode("/", $date_form);
$date = $date_array[2] . '-' . $date_array[0] . '-' . $date_array[1];

$sSQL = "SELECT * FROM news where date='$date'";

$oResult = mysql_query($sSQL);

$content = "";

$div_inicio = "<div id='container_news'>";
$ul_inicio = "<ul>";
$ul_final = "</ul>";
$element = "";
$cont_news = 0;
$content_news = "";
$news_id = "";

if(mysql_num_rows($oResult)>0)
{
	while ($news = mysql_fetch_array($oResult))
    {
		if($cont_news==0)
		{
			$news_id = $news['id'];
		}
		
		$cont_news = $cont_news + 1;
		
		$element .= '<li><a onclick="get_comments('.$news['id'].')" href="#news'.$cont_news.'">'. utf8_encode($news['title']) .'</a></li>';
		
		$content_news .= '<div id="news'.$cont_news.'">'.utf8_encode($news['content']).'</div>';
	}
	
	$div_final = '</div>';
	$content = '<div id="container_news">' . $div_inicio . $ul_inicio . $element . $ul_final . $content_news . $div_final . '</div>';
	
}

$content_all = array("content"=>$content,"news_id"=>$news_id);

echo json_encode($content_all);

?>