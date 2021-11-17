<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

include '../bd/bd.php';
$bd=new bd();

$nombre = strtolower(trim($_POST['nombre']));
$document = trim($_POST['document']);
$genero = $_POST['genero'];
$cargo = $_POST['cargo'];
$email = strtolower(trim($_POST['email']));
$password = md5($_POST['password']);
$fechacreacion = date('Y-m-d H:i:s');

$sql="INSERT INTO empleado (nombre,documento,IDcargo,genero) VALUES ('".$nombre."', '".$document."', '".$cargo."', '".$genero."');";
$IDempleado=$bd->insertar($sql);

$sql="INSERT INTO usuario (correo,clave,fechacreacion,IDempleado) VALUES ('".$email."', '".$password."', '".$fechacreacion."', ".(int)$IDempleado.");";
$bd->insertar($sql);

header('Content-Type: application/json');
echo json_encode(1,JSON_FORCE_OBJECT);