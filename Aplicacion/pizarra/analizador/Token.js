/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var signos;
var operadores;
var delimitadores;
var operadoresRelacionales;
var etiquetas;


function Token(){
    
    signos = new Array();    
    signos[0]='+';
    signos[1]='-';
    
    operadores = new Array();
    operadores[0] = '*';
    operadores[1] = '-';
    operadores[2] = '/';
    operadores[3] = '+';
    operadores[4] = '^';
    
    delimitadores = new Array();
    delimitadores[0] = '{';
    delimitadores[1] = '[';
    delimitadores[2] = '(';
    delimitadores[3] = ')';
    delimitadores[4] = ']';
    delimitadores[5] = '}';
    
    operadoresRelacionales = new Array();
    operadoresRelacionales[0] = "&lt;";
    operadoresRelacionales[1] = "&le;";
    operadoresRelacionales[2] = "&gt;";
    operadoresRelacionales[3] = "&ge;";
    operadoresRelacionales[4] = "&ne;";
    operadoresRelacionales[5] = "&asymp;";
    
    etiquetas = new Array();
    etiquetas[0] = "<sub>";
    etiquetas[1] = "</sub>";
    etiquetas[2] = "<sup>";
    etiquetas[3] = "</sup>";
    
    
}


Token.prototype.esSigno = function(caracter){
    for (var i = 0; i < signos.length; i++) {
        if(caracter === signos[i])
            return true
    }
    return false;
}

Token.prototype.esOperador = function(caracter){
    for (var i = 0; i < operadores.length; i++) {
        if(caracter === operadores[i])
            return true
    }
    return false;
}

Token.prototype.esSeparador = function(caracter){
    for (var i = 0; i < delimitadores.length; i++) {
        if(caracter === delimitadores[i]){
            return true;
        }
    }
    return false;
}

Token.prototype.esOperadorRelacional = function(cadena){
    for (var i = 0; i < operadoresRelacionales.length; i++) {
        if(cadena == operadoresRelacionales[i]){
            return true;
        }
    }
    return false;
}

Token.prototype.esEtiqueta = function (cadena){
    for (var i = 0; i < etiquetas.length; i++) {
        if(cadena == etiquetas[i]){
            return true;
        }
    }
    return false;
}
// a +b = c-d/(F^(-4/3))*1
Token.prototype.esNumero = function(valorAscii){
    return (valorAscii >=48 && valorAscii<=57) ? true: false;
}


Token.prototype.esLetra = function(valorAscii){
    return (valorAscii >= 65 && valorAscii <= 90) || 
        (valorAscii >= 97 && valorAscii <= 122)  || 
        (valorAscii == 164) || (valorAscii == 165) ? true : false;
}

Token.prototype.esIgualdad = function(caracter){
    return caracter === '=' ? true: false;
}

Token.prototype.esEspacio = function(valorAscii){
    return valorAscii == 32 || valorAscii == 10 ? true : false;
}
