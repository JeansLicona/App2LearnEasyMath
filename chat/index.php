<!DOCTYPE html>
<html lang="en">
    <head>
        <title>JQUERY UI</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		 <link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">

		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery-ui-1.10.4.custom.js"></script>
	
       <script type="text/javascript">
            $(function(){
			
			$('#TxtMessage').focus();
			
				get_messages();
				//get_new_messages();
			
            });

//$sQuery = "SELECT MAX(id_mensaje) AS maximo_id FROM mensaje";

$(document).ready(function(){

	setInterval(function(){
	
	get_new_messages();
	
	},2000);
	
});




function get_new_messages(){
	
	var value_rand = (-0.5)+(Math.random()*(100.99));
	var id_last_message  = $("#id_last_message").val();
	
	$.ajax({
		url:'new_messages.php', 
		type: 'GET',
		dataType: 'json',
		data: {
               "id_last_message": id_last_message, "rand" : value_rand
        },
		
		success: function(answer){
		
			if(answer.content!=''){
				$("#container_messages").append(answer.content);
				$("#id_last_message").val(answer.id_last_message);
			}
		},
		
		error:function(){
			 alert("Lo sentimos el servidor tiene problemas. Intente mas tarde");
		}
	});
	
}

        </script>



	 
	<script type="text/javascript">
	
	function get_messages()
	{
		$.ajax({
			url:'messages.php', 
			type: 'GET',
			dataType: 'json',
			success: function(answer){
			
			//VALIDAR SI EL ANSWER NO ES VACIO, ENTONCES...
			//$("#container_messages").append(answer.content);
			$("#container_messages").html(answer.content);
			
			$("#last_id_message").val(answer.id_last_message);
				
				
				},
					error:function(){
						alert("ERROR");
					}
				});
	}

	</script>
	
	<style>
	body{
		font: 82.5% "Trebuchet MS", sans-serif;
		margin: 50px;
	}

	#container_dialog{
	display:none;
	}
	#container_messages{
		width:200px;
		height:300px;
		background-color:yellow;
	}
	
	</style>
	
    </head>
    <body>
	
	<?php
	/*
	SELECT * FROM ((SELECT id_mensaje,m.usuario,mensaje,fecha_hora FROM mensaje m ORDER BY id_mensaje DESC LIMIT 20) AS messages ORDER BY id_mensaje ASC ) JOIN usuario ON m.usuario=usuario.id 
	*/
	/*
	include("lib.php");

$link = connectDB();

$sql = "SELECT * FROM ";
$sql .= "(SELECT id_mensaje,mensaje.ususario,usuario.usuario,mensaje,fecha_hora FROM mensaje ORDER BY id_mensaje DESC LIMIT 20) ";
$sql .= "AS messages ORDER BY id_mensaje ASC JOIN usuario ON mensaje.usuario=usuario.id ";

echo $sql;
$result = mysqli_query($link,$sql);

$num_rows = mysqli_num_rows($result);



if($num_rows>0)
{

	while ($message = mysqli_fetch_array($result))
	{

echo $message['id_mensaje'] . "ss";
}
}
*/
	?>
	
	<input type="hidden" id="id_last_message" name="id_last_message" value="0">

		<div id="container_messages">
		<!--
			<div id="container_messages">
			</div>
		-->
		</div>
		
<div id="div_form_message">
<form action="save_message.php" id="form_message">
	<p>
		Message <br />

			<textarea type="text" id="TxtMessage" name="TxtMessage" cols="35" rows="2" ></textarea> 
		<input type="submit" value="Save">
	</p>
</form>
</div>

		<script type="text/javascript">

// Attach a submit handler to the form
$( "#form_message" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();

  // Get some values from elements on the page:
  var $form = $( this ),
	message = $form.find( "textarea[name='TxtMessage']" ).val(),
    url = $form.attr( "action" );
	
	//FALTA VALIDAR QUE NO ACEPTE UNICAMENTE ENTERS
	
	if($.trim(message!='')){
	
		  $.post( url,
				{ TxtMessage: message },
				function(answer) {
					
					$("#TxtMessage").val('').focus();
					
					$("#container_messages").append(answer.message);
					
				},'json');
		}
		
});

</script>
    </body>
</html>
