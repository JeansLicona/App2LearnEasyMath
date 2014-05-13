<!DOCTYPE html>
<html lang="en">
    <head>
        <title>JQUERY UI</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		 <link href="css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
		<script src="js/jquery-1.10.2.js"></script>
		<script src="js/jquery-ui-1.10.4.custom.js"></script>
	
	<style>
	body{
		font: 82.5% "Trebuchet MS", sans-serif;
		margin: 50px;
	}
	
	</style>
	
    </head>
    <body>

		
<div id="div_form_login">


<div id="result_login">
</div>

<form action="validate_login.php" id="form_login">
	<p>
		<label>Usuario</label>
		<br />
		<input type="text" name="TxtUserName" id="TxtUserName" />
		<br />
		<label>Contrase&ntilde;a </label>
		<br />
		<input type="text" name="TxtPassword" id="TxtPassword"/>
		<br />
		<input type="submit" value="Ingresar">
	</p>
</form>
</div>

<script type="text/javascript">

// Attach a submit handler to the form
$( "#form_login" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();

  // Get some values from elements on the page:
  var $form = $( this ),
	txtUserName = $form.find( "input[name='TxtUserName']" ).val(),
	txtPassword = $form.find( "input[name='TxtPassword']").val(),
    url = $form.attr( "action" );
	
		  $.post( url,
				{ TxtUserName: txtUserName, TxtPassword: txtPassword },
				function(answer) {
					
					$("#txt_message_login").remove();
					
					if(answer.status_login!='logueado'){
					
						$("#result_login").empty();
						$("#result_login").append(answer.status_login);
					
					}else if(answer.status_login=='logueado'){
		
						window.location = 'index.php';
					
					}
					
				},'json');
});

</script>
    </body>
</html>
