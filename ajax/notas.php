<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);

include '../bd/bd.php';
$bd=new bd();

$ticket = $_POST['ajaxticket'];

$sql = 'SELECT 
nt.IDnota AS idnota,
nt.fechacreacion AS fechacreacion,
nt.Descripcion AS descripcion,
e.nombre AS nombre,
i.importancia AS importancia
FROM nota_ticket nt
INNER JOIN usuario u ON u.IDusuario = nt.IDusuario
INNER JOIN empleado  e ON e.IDempleado = u.IDempleado
INNER JOIN importancia i ON i.idimportancia = nt.idimportancia
WHERE nt.IDticket ='.$ticket.'
ORDER BY fechacreacion DESC';
$resultado = $bd->consultar($sql);  
$notastickets = array();
while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
    array_push($notastickets,$fila);
}
foreach($notastickets as $notaticket){
?>

<div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            <?php echo $notaticket['fechacreacion']?>
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <div class="form-group">
                <?php echo $notaticket['nombre']?>
                </div>
            <?php echo $notaticket['descripcion']?>
                
            </div>
        </div>
    </div>
</div>
<?php
} 
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
