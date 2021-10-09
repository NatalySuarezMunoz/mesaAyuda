<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'bd/bd.php';
$bd=new bd();
$resultado=$bd->consultar("hola");

print_r($resultado);