<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'bd/bd.php';
$bd=new bd();

$sql = 'SELECT 
t.IDtiket AS ticket,
t.fechacreacion AS fechainicio,
e.IDempleado AS IDempleado,
e.nombre AS empleado,
et.estado AS estado
FROM ticket t 
INNER JOIN nota_ticket nt ON nt.IDticket = t.IDtiket
INNER JOIN empleado e ON e.IDempleado = t.IDempleado
INNER JOIN estado_ticket et ON et.IDestado_ticket = nt.IDestado
ORDER BY t.fechacreacion DESC';
$resultado = $bd->consultar($sql);  
$tickets = array();
while ($fila = $resultado->fetch_array(MYSQLI_ASSOC)) {
    array_push($tickets,$fila);
}
?>
<div>
    <section>
        <article class="section-content-page diametro">
            <h3 class="titulo">Bandeja Ticket</h3>
            <h4 class="subtitulo">Consulte el estado de los ticket que actualmente tiene en su bandeja</h4>

            <form>
                <div class="search">
                    <input type="text" class="form-control" name="casos" placeholder="Busque por n&uacute;mero o cliente" aria-describedby="sizing-addon1">
                    <button class="btn-gris" type="submit">Buscar</button>
                </div>

                <div>
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">N&uacute;mero</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Empleado</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Gestionar</th>
                            </tr>
                        </thead>
                        <tbody id="viewlist">
                            <?php
                            foreach($tickets as $ticket){
                            ?>
                            <tr> 
                                <td><?php echo $ticket['ticket']?></td>
                                <td><?php echo $ticket['fechainicio']?></td>
                                <td><?php echo $ticket['empleado']?></td>
                                <td><?php echo $ticket['estado']?></td>
                                <td><a onclick="edit(<?php echo $ticket['IDempleado']?>)"><img src="img/edit-icon.png"/></a></td> 
                            </tr>
                            <?php
                            } 
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="new">
                    <button class="btn-gris" type="submit" onclick="newTicket(); return false;">Crear Ticket</button>
                </div>
            </form>
        </article>
    </section>
</div>

<script type="text/javascript">   


        function newTicket() {                   
            $.ajax({
                method: "post",
                url: "newticket.php",
                data: {},
                success: function(data) {
                $("#content").html(data)
            }
        })
    }
</script>