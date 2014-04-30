<!DOCTYPE html>
<html>
    <head>
        <title>JQUERY UI</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
        <!--<script src="ckfinder/ckfinder.js" type="text/javascript"></script>-->
        <script src="jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script src="ckeditor/ckeditor.js"></script>
        <link href="jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />

        <script type="text/javascript">
           $(function(){
               var editor=CKEDITOR.replace('texto',{
                  // customConfig : 'config.js'
               });
                    //    editor.setData('<p>pulsa en el <b>boton</b></p>');
                      //  CKFinder.setupCKEditor(editor, '/ckfinder/') ;
           });
             
        </script>
    </head>
    <body>
    	 <textarea class="texto" id="texto" name="texto"></textarea>
    </body>
</html>
