<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include '../bd/bd.php';
$bd=new bd();

$buscarticket = $_POST['ticketAjax'];

$sql = 'SELECT 
t.IDtiket AS ticket,
t.fechacreacion AS fechainicio,
et.estado AS estado,
e.IDempleado AS IDempleado,
e.nombre AS empleado
FROM nota_ticket nt 
INNER JOIN ticket t ON t.IDtiket = nt.IDticket
INNER JOIN estado_ticket et ON et.IDestado_ticket = nt.IDestado
INNER JOIN empleado e ON e.IDempleado = t.IDempleado';


$sql .= ($buscarticket != '')? ' WHERE t.IDtiket = '.$buscarticket : '';

$sql .= ' GROUP BY nt.IDticket
ORDER BY nt.fechacreacion DESC';
$resultado = $bd->consultar($sql);  
$tickets = array();
while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
    array_push($tickets,$fila);
}
if (count($tickets) > 0){

foreach($tickets as $ticket){
?>
<tr> 
    <td><?php echo $ticket['ticket']?></td>
    <td><?php echo $ticket['fechainicio']?></td>
    <td><?php echo $ticket['empleado']?></td>
    <td><?php echo $ticket['estado']?></td>
    <td><a onclick="gestionticket(<?php echo $ticket['ticket']?>)"><img src="img/edit-icon.png"/></a></td> 
</tr>
<?php
} 
}
?>