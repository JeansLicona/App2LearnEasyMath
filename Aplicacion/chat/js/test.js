function uploadFile( file ){
	//5MB
	var limit = 1048576*2,xhr;

	console.log( limit  )

	if( file ){
		if( file.size < limit ){
			if( !confirm('Desea cargar este archivo?') ){return;}

			xhr = new XMLHttpRequest();

			xhr.upload.addEventListener('load',function(e){
				alert('Archivo cargado!');
			}, false);

			xhr.upload.addEventListener('error',function(e){
				alert('Ha habido un error al subir el archivo :/');
			}, false);

			xhr.open('POST','upload.php');

            xhr.setRequestHeader("Cache-Control", "no-cache");
            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            xhr.setRequestHeader("X-File-Name", file.name);

            xhr.send(file);
		}else{
			alert('El archivo es mayor que 2MB!');
		}
	}
}

var upload_input = document.querySelectorAll('#archivo')[0];

upload_input.onchange = function(){
	uploadFile( this.files[0] );
};