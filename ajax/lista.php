<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include '../bd/bd.php';
$bd=new bd();

$nombre = $_POST['nombreAjax'];
 

$sql= "    SELECT DISTINCT e.IDempleado, " .
      "    				   e.nombre, " .
      "    				   e.documento, " .
      "                    u.correo, " .
      "                    c.cargo " .
      "               FROM usuario u " .
      "         INNER JOIN empleado e ON e.IDempleado = u.IDempleado " .
      "         INNER JOIN cargo c on c.IDcargo = e.IDcargo " .
      "         	  WHERE u.estado = 1 ";
if($nombre != ''){
    $sql .= "AND (e.nombre LIKE '%".$nombre."%'" .
            " OR e.documento LIKE '%".$nombre."%'" .
            " OR u.correo LIKE '%".$nombre."%')";
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
 <td><?php echo $usuario['correo']?></td>
 <td><?php echo $usuario['cargo']?></td>
 <td><a onclick="edit(<?php echo $usuario['IDempleado']?>)"><img src="img/edit-icon.png"/></a></td> 
</tr>
<?php
} 
?>