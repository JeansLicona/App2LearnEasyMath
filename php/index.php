<?php

    /*
     * To change this template, choose Tools | Templates
     * and open the template in the editor.
     */
?>
<html>
    <head>
        <title>Ejemplo CKEditor</title>
        <script src="../lib/ckeditor/ckeditor.js"></script>
        <script src="../jquery/jquery-1.11.0.min.js"></script>
        <script>
           $(document).ready(function(){CKEDITOR.replace("texto");});
            
        </script>
    </head>
    <body> 
        <textarea name="texto" id="texto"> </textarea>
    </body>
</html>