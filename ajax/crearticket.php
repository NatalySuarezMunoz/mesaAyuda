<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);

include '../bd/bd.php';
$bd=new bd();

$fechaInicio = date("Y-m-d H:i:s");


$titulo = trim(ucfirst($_POST['titulo']));
$idempleado = $_SESSION['idempleado'];
$importancia = trim($_POST['importancia']);
$tipot = trim($_POST['tipoticket']);
$descripcion = $_POST['descripcion'];

$sql = "INSERT INTO ticket (titulo,IDempleado,fechacreacion) VALUES ('".$titulo."', '".$idempleado."', '".$fechaInicio."');";
$idticket = $bd->insertar($sql);
$sql = "INSERT INTO nota_ticket (IDticket,fechacreacion,descripcion,IDestado,IDusuario,idtipoticket,idimportancia) VALUES ("
.$idticket.", '"
.$fechaInicio."', '"
.$descripcion."',
1,"
.$_SESSION['idusuario'].","
.$tipot.","
.$importancia.");";
$bd->insertar($sql);

header('Content-Type: application/json');
echo json_encode('ok',JSON_FORCE_OBJECT);
?>