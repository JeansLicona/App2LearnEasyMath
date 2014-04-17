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
			
				get_messages();
			
				//get_new_messages();
			
            });

//$sQuery = "SELECT MAX(id_mensaje) AS maximo_id FROM mensaje";

$(document).ready(function(){

	setInterval(function(){
	
	//get_new_messages();
	
	},5000);
	
});




function get_new_messages(){
	
	var value_rand = (-0.5)+(Math.random()*(100.99));
	
	$.ajax({
		url:'new_messages.php', 
		type: 'GET',
		dataType: 'json',
		data: {
               "saludo": "hola", "rand" : value_rand
        },
		
		success: function(answer){
		
			$("#container_messages").append(answer.content);
				//$("#accordion").html(data);
		},
		
		error:function(){
			 alert("Lo sentimos el servidor tiene problemas intente mas tarde");
		}
	});
	
}


        </script>

<script type="text/javascript">
/*
function get_messages_by_date(date)
{
	$.get( "newspaperbydate.php",
				{ date: date },
				function(respuesta) {
				
				$("#container_news").remove();
		
				$("#message").append(respuesta.content);
				
				$("#container_news").tabs();
				
				if(respuesta.news_id!="")
				{
					$("#dialog").css("display", "block");
					//$("#dialog-link").css("display", "block");
					$("#container_dialog").css("display", "block");
					show_dialog();
				}
			
				},'json');
}
*/
</script>

	 
	<script type="text/javascript">
	
	function get_messages()
	{
		$.ajax({
			url:'messages.php', 
			type: 'GET',
			dataType: 'json',
			success: function(answer){
			
			$("#container_messages").append(answer.content)
			/*		$("#container_dialog").css("display", "block");
					show_dialog();				
					$("#container_news").remove();
					$("#message").append(respuesta.message);
					$("#container_news").tabs();
			*/	
			//alert(respuesta.content);
			
				
				},
					error:function(){
						alert("ERROR");
					}
				});
	}
	/*
	$(document).ready(function()
{
    var refreshId = setInterval( function() 
    {
        var r = (-0.5)+(Math.random()*(1000.99));
        $('#img-container').load('images/gallery/best/random.php?'+r);
    }, 5000);
});
	*/
	</script>
	
	<style>
	body{
		font: 82.5% "Trebuchet MS", sans-serif;
		margin: 50px;
	}
	
	/*#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
		display: none;
	}*/
	/*#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}*/
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	
	#date_commment{
		font-size:13px;
	}
	#container_dialog{
	display:none;
	}
	#container_messages{
		width:200px;
		height:300px;
		background-color:yellow;
	}
	/*
	#container_border_message{
		widht:200px;
		height:20px;
		background-color:red;
	}
	*/
	/*
	#container_on_message{
		widht: 180px;
		height:18px;
		background-color:black;
	}
	*/
	/*
	#dialog{
	display:none;
	}*/
	</style>
	
    </head>
    <body>


		<div id="container_messages">
		</div>
		
<div id="div_form_message">
<form action="save_message.php" id="form_message">
	<p>
		Message <br />
		<!-- cols="40" rows="2" -->
		<!-- <div id="container_border_message"> -->
			<textarea type="text" id="TxtMessage" name="TxtMessage" cols="35" rows="2" ></textarea> 
		<!-- </div> -->
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
	
	if(message!=""){
	
		  $.post( url,
				{ TxtMessage: message },
				function(answer) {
					
					$("#TxtMessage").val("");
					
					$("#container_messages").append(answer.message);
					
				},'json');
		}
		
});

</script>
    </body>
</html>
