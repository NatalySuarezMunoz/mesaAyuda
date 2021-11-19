<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);

include '../bd/bd.php';
$bd=new bd();

$com = $_POST['comajax'];
$importancia = $_POST['selectajax'];
$tipo = $_POST['tipoajax'];
$ticket = $_POST['ajaxticket'];

$fecha = date('Y-m-d H:i:s');
$activo = $_POST['activoajax'];

$sql = 'INSERT INTO nota_ticket (IDticket,fechacreacion,IDestado,IDusuario,idtipoticket,idimportancia,Descripcion) VALUES ('.
$ticket.',"'.
$fecha.'",1,'.
$_SESSION['idusuario'].','.
$tipo.','.
$importancia.',"'.
$com.'");';
$notaid = $bd->insertar($sql);


if ($activo == true){
 $sql = 'UPDATE nota_ticket SET IDestado = 2 WHERE IDticket ='.$ticket.';';
 $bd->consultar($sql);
 $sql = 'UPDATE ticket SET fechacierre = "'.$fecha.'" WHERE IDtiket ='.$ticket.';';
 $bd->consultar($sql);
}

header('Content-Type: application/json');
echo json_encode($ticket,JSON_FORCE_OBJECT);

?>