<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include '../bd/bd.php';
$bd=new bd();

$nombre = $_POST['nombreAjax'];
 

$sql= "    SELECT DISTINCT empleado.IDempleado, " .
      "    				   empleado.nombre, " .
      "    				   empleado.documento, " .
      "                    login.usuario, " .
      "                    cargo.cargo " .
      "               FROM login " .
      "         INNER JOIN empleado ON empleado.IDempleado = login.IDempleado " .
      "         INNER JOIN cargo on cargo.IDcargo = empleado.IDcargo " .
      "         	  WHERE login.estado = 'Activo' ";
if($nombre != ''){
    $sql .= "AND (empleado.nombre LIKE '%".$nombre."%'" .
            " OR empleado.documento LIKE '%".$nombre."%'" .
            " OR login.usuario LIKE '%".$nombre."%')";
}
$resultado=$bd->consultar($sql);  
$usuarios=array();
while ($fila=$resultado->fetch_array(MYSQLI_ASSOC)) {
    array_push($usuarios,$fila);
}
?>

<?php
foreach($usuarios as $usuario){
?>
<tr> 
 <td><?php echo $usuario['nombre']?></td>
 <td><?php echo $usuario['documento']?></td>
 <td><?php echo $usuario['usuario']?></td>
 <td><?php echo $usuario['cargo']?></td>
 <td><a onclick="edit(<?php echo $usuario['IDempleado']?>)"><img src="img/edit-icon.png"/></a></td> 
</tr>
<?php
} 
?>