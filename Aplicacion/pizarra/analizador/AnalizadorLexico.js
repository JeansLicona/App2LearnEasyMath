/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var analizar;
var tokens;
var numeroToken;

function AnalizadorLexico(){
    tokens = new Array(); 
    numeroToken = 0;
    analizar = new Token();
}

AnalizadorLexico.prototype.obtenerTokens = function (contenido){
    var contador;
    var desconocido;

      for (var i = 0; i < contenido.length; i++){
           var caracter = contenido.charAt(i);
           
           if (analizar.esSigno(caracter)) {
                
                agregarToken(caracter,"Signo"); 
                
            } else if(analizar.esNumero(caracter.charCodeAt(0))) {
                
                var numero="";
                var caracterAux=caracter;
                contador=i;

                do{
                    numero +=caracterAux;
                    contador++;
                    caracterAux=contenido.charAt(contador);
                }while(analizar.esNumero(caracterAux.charCodeAt(0)));
                
                i=contador-1;
                
                agregarToken(numero,"Numero");
                
            } else if(analizar.esLetra(caracter.charCodeAt(0))) {
                
                agregarToken(caracter,"literal");
                
            } else if(analizar.esOperador(caracter)) {
                
                agregarToken(caracter,"operador");
                
            } else if(analizar.esIgualdad(caracter)) {
                
                agregarToken(caracter,"Igualdad");
            
            } else if( analizar.esEspacio(caracter.charCodeAt(0))){
            
            } else if( analizar.esSeparador(caracter)){
                
                agregarToken(caracter,"Separador");
                
            }else if( caracter === '<'){
                
                desconocido = "";
                contador = i;
                                
                while( caracter != '>'){
                    desconocido += caracter;
                    contador++ ;
                    caracter = contenido.charAt(contador);
                }
                                
                desconocido += caracter;
                i=contador;
                                //{a+b - c/(-4*5a)}*[({})] ? ^10 = 20p
                if(analizar.esEtiqueta(desconocido)){
                    
                    agregarToken(desconocido,"Etiqueta");
                    
                }
                
            }else if(caracter === '&'){
                
                desconocido="";
                contador=i;
                
                while( caracter != ';'){
                    desconocido += caracter;
                    contador++ ;
                    caracter = contenido.charAt(contador);
                }

                desconocido += caracter;
                i=contador-1;
                                    
                if(analizar.esOperadorRelacional(desconocido)){
                    
                    agregarToken(desconocido,"Operador Relacional")
                    
                }
                
            }else{
                    
                    agregarToken(caracter,"Desconocido");
                    
                 }
        }
    
    return tokens;
}

var agregarToken = function(token,leyenda){
    tokens[numeroToken]=new Array(2);
    tokens[numeroToken][0]=token;
    tokens[numeroToken][1]=leyenda;
    numeroToken++;
}

AnalizadorLexico.prototype.obtenerTamanio = function (){
    return numeroToken;
}