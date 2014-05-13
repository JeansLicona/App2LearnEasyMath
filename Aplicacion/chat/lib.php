<?php

	function connectDB()
	{
		$link = mysqli_connect('localhost', 'root','','pizarra_virtual');
		
		if(!$link)
		{
			die('Error de conexión ('.mysqli_connect_errno().')'.mysqli_connect_error());
		}
		mysqli_query($link,'SET NAMES utf8');
		
		return $link;
	}

?>