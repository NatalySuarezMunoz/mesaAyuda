<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include '../bd/bd.php';
$bd=new bd();

$user = trim(strtolower($_POST['userAjax']));
$password = md5($_POST['passwordAjax']);
$sql='select * from usuario where correo="'.$user.'" and clave="'.$password.'";';                 
$resultado=$bd->consultar($sql);
$login = $resultado->fetch_object();
$accion = null;
$error = true;
if (!empty($login->correo)){
    $sql='select * from empleado where idempleado = '.$login->IDempleado;
    $resultado = $bd->consultar($sql);
    $empleado = $resultado->fetch_object();
    session_start();//declaramos una sesion de usuario
    $_SESSION['idusuario'] = $login->IDusuario;
    $_SESSION['idempleado'] = $login->IDempleado;
    $_SESSION['nombre'] = $empleado->nombre;
    $_SESSION['documento'] = $empleado->documento;
    $_SESSION['userAgent']  = $_SERVER['HTTP_USER_AGENT'];//toma una variable del servidor
    $_SESSION['SKey'] 		= uniqid(mt_rand(), true);//crea un token unico mientras este logueado
    $_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];//calcula el tiempo en que se inicio la sesion 
    $_SESSION['activo']		= time();//registrar momento del logueo del cliente
    $_SESSION['fecha'] 		= time();//registrar momento del logueo del cliente
    $fechaInicio = date("Y-m-d H:i:s");
    $sql = 'update usuario set ultimasesion = "' . $fechaInicio.'" where IDusuario = ' . $_SESSION['idusuario'].';';
    $bd->consultar($sql);
    $accion = 'index.php';
    $error = false;
}
else{
    $accion = 'usuario o contraseña incorrectos';
    $error = true;
}
header('Content-Type: application/json');
echo json_encode(array('accion'=> $accion, 'error'=> $error),JSON_FORCE_OBJECT);

?>