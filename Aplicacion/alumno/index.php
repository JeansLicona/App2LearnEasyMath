<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include_once '../util/ComandosBD.php';
$dateNow=new DateTime("now");

$prueba=new ComandosBD();
$prueba->insert("tutor", 
        array('nombres'=>'Wilberth', 
            'apellidos'=>'Rivas',
            'seccion'=>'xdxd',
            'fecha_nacimiento'=>'1990-10-09',
            'fecha_ingreso'=>$dateNow->format("Y-m-d"),
            'correo'=>'cloud_ultimate@hotmail.com'));
?>
