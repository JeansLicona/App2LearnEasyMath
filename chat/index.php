<!DOCTYPE html>
<html lang="en">
    <head>
        <title>JQUERY UI</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		 <link href="../jquery/css/ui-darkness/jquery-ui-1.10.4.custom.css" rel="stylesheet">

		<script src="../jquery/jquery-1.11.0.min.js"></script>
		<script src="../jquery/js/jquery-ui-1.10.4.custom.js"></script>
	
        <script type="text/javascript">
            $(function(){
			get_messages();
            });

        </script>

<script>

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
</script>

	 
	<script>
	
	function get_messages()
	{
		$.ajax({
			url:'messages.php', 
			type: 'GET',
			dataType: 'json',
			success: function(answer){
			$("#container_messages").append(answer.content)
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
	/*
	#dialog{
	display:none;
	}*/
	</style>
	
    </head>
    <body>

<input type="button" id="all_news" value="All news"/>

		<div id="container_messages">
		</div>
		

	

<div id="result"></div>

<div id="dialog" title="Add comment">
<form action="save_message.php" id="form_message">
	<p>
		Message <br />
		<textarea type="text" id="TxtMessage" name="TxtMessage" cols="40" rows="2" ></textarea>
		<input type="submit" value="Save">
	</p>
</form>

</div>

		<!--<h2 class="demoHeaders">Comments</h2>-->
		<!--
        <div id="accordion">
        </div>
		-->
		<script>

// Attach a submit handler to the form
$( "#form_message" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();

  // Get some values from elements on the page:
  var $form = $( this ),
	message = $form.find( "textarea[name='TxtMessage']" ).val(),
    url = $form.attr( "action" );
  $.post( url,
		{ TxtMessage: message },
		function(answer) {
			
			$("#TxtMessage").val("");
			
			$("#container_messages").append(answer.message);
			//alert(answer.message);
		},'json');
		
});

</script>
    </body>
</html>
