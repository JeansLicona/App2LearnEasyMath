<?php
/*
session_start();

if(!isset($_SESSION['logueado']) && $_SESSION['logueado']!='si')
{
	header('Location: login.php');
	exit();
}*/
?>
		
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Chat</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		 <link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
		<link href="../estilos/style.css" rel="stylesheet">	
		
		
		<script src="ckeditor/ckeditor.js"></script>
        <script src = "jquery-1.11.0.min.js" type = "text/javascript"></script>
		
		 
		 
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery-ui-1.10.4.custom.js"></script>
		
		
	
       <script type="text/javascript">
            $(function(){
			
			$('#TxtMessage').focus();
			
				//get_messages();
				//get_new_messages();
			
            });

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
		/*
		error:function(){
			 alert("Lo sentimos el servidor tiene problemas. Intente mas tarde");
		}
		*/
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
	
	</head>
    <body>
	
	<h2> CHAT </h2>
	<a href='logout.php'>Salir</a><br />
	
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
<div id = "chat-container">
		<div id="container_messages">
		
		</div>
		
<div id="div_form_message">
<form action="save_message.php" id="form_message">
	<p>
		Mensaje <br />

			<textarea type="text" id="TxtMessage" name="TxtMessage" cols="45" rows="2"  placeholder="Escriba Aqu&iacute; su Mensaje" required autofocus></textarea> 
			</br>
			</br>
		<input type="submit" value="Enviar" class="btn btn-lg btn-primary btn-chat">
	</p>
</form>
</div>

</div>



<!-- CKEDITOR -->
<div id = "ckeditor-panel">

<textarea id="texto" name="texto" cols="" rows=""></textarea>

			<script>
                CKEDITOR.replace('texto');
            </script>

</div>
		<h4>Subir archivos al sevidor:</h4>
	<input type="file" id="archivo" class="btn btn-lg btn-primary btn-chat"/>

	<script src="js/test.js"></script>

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
