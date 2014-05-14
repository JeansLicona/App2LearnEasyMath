/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var arreglo;

function Pila(){
    arreglo = new Array();
}

Pila.prototype.pop = function(){
    try{
        arreglo.pop();
    }catch(err){}
}

Pila.prototype.agregar = function(objeto){
    arreglo.push(objeto);
}

Pila.prototype.quitar = function(){
    return arreglo[arreglo.length-1];
}

Pila.prototype.isEmpty =function(){
    return arreglo.length == 0 ? true : false;
}

Pila.prototype.getSize = function(){
    return arreglo.length;
}