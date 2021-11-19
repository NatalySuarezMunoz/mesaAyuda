<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'bd/bd.php';
$bd=new bd();


$ticket = $_POST['ajaxticket'];

$sql = 'SELECT 
t.IDtiket AS ticket,
t.fechacreacion AS fechainicio,
e.IDempleado AS IDempleado,
e.nombre AS empleado,
et.estado AS estado,
t.titulo AS titulo,
et.IDestado_ticket AS IDestado
FROM ticket t 
INNER JOIN nota_ticket nt ON nt.IDticket = t.IDtiket
INNER JOIN empleado e ON e.IDempleado = t.IDempleado
INNER JOIN estado_ticket et ON et.IDestado_ticket = nt.IDestado
WHERE t.IDtiket = '.$ticket.'
ORDER BY t.fechacreacion DESC
LIMIT 1';
$resultado = $bd->consultar($sql);
$gestionar = $resultado->fetch_object();

$sql='SELECT * FROM importancia order by importancia' ;
$resultado=$bd->consultar($sql);  
$importancias=array();
while ($fila=$resultado->fetch_array(MYSQLI_ASSOC)) {
 array_push($importancias,$fila);
}

$sql='SELECT * FROM tipoticket order by tipoticket' ;
$resultado=$bd->consultar($sql);  
$tipos=array();
while ($fila=$resultado->fetch_array(MYSQLI_ASSOC)) {
 array_push($tipos,$fila);
}

include 'lib/head.php';
?>
<div>
    <section>
        <article class="section-content-page diametro">
            <h3>Gestionar Ticket</h3>

            <div class="user-form">
                <section>
                    <article>
                        <div class="header-details-ticket">
                            <section>
                                <article>
                                    <div class="details-ticket details-ticket-font">
                                        <span>TICKET </span>
                                        <span><?php echo $ticket; ?></span>
                                    </div>
                                </article>

                                <article class="align-right">
                                    <section>
                                        <article>
                                            <div class="details-ticket-subtitle">
                                                <span>Fecha de inicio</span>
                                            </div>
                                        </article>
                                        <article>
                                            <div class="details-ticket-field">
                                                <span><?php echo $gestionar->fechainicio?></span>
                                            </div>
                                        </article>
                                    </section>
                                </article>

                                <article class="align-right">
                                    <section>
                                        <article>
                                            <div class="details-ticket-subtitle">
                                                <span>Fecha vence</span>
                                            </div>
                                        </article>
                                        <article>
                                            <div class="details-ticket-field">
                                                <span>09/09/2021 16:25</span>
                                            </div>
                                        </article>
                                    </section>
                                </article>
                            </section>
                        </div>

                        <div class="header-details-ticket">
                            <section>
                                <article class="align-right">
                                    <section>
                                        <article>
                                            <div class="details-ticket-subtitle">
                                                <span>Creado por:</span>
                                            </div>
                                        </article>
                                        <article>
                                            <div class="details-ticket-field">
                                                <span><?php echo $gestionar->empleado?></span>
                                            </div>
                                        </article>
                                    </section>
                                </article>

                                <article class="align-right">
                                    <section>
                                        <article>
                                            <div class="details-ticket-subtitle">
                                                <span>Estado</span>
                                            </div>
                                        </article>
                                        <article>
                                            <div class="details-ticket-field">
                                                <span><?php echo $gestionar->estado?></span>
                                            </div>
                                        </article>
                                    </section>
                                </article>
                            </section>
                        </div>

                        <div class="header-details-ticket">
                            <div class="text-center">
                               <h2><?php echo $gestionar->titulo?></h2>
                            </div>
                        </div>

                        <div class="body-details-ticket">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#actuaciones">Actuaciones</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#trazabilidad">Trazabilidad</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="actuaciones" class="container tab-pane active"><br>
                                    <form method="POST">
                                        <textarea rows="5" name="comentarios" id="comentarios" placeholder="Discusion" <?php echo ($gestionar->IDestado == 2)?'disabled':'';?>></textarea>
                                            <label class="control-label">Importancia</label>
                                            <select id="importancia" class="form-control" <?php echo ($gestionar->IDestado == 2)?'disabled':'';?>>
                                                <option value="">Seleccione</option>
                                                <?php foreach($importancias as $importancia){?>
                                                        <option value="<?php echo $importancia['idimportancia']?>"><?php echo $importancia['importancia']?></option>
                                                <?php } ?>
                                            </select>
                                            <br>
                                            <label class="control-label">Tipo</label>
                                            <select id="tipo" class="form-control" <?php echo ($gestionar->IDestado == 2)?'disabled':'';?>>
                                                <option value="">Seleccione</option>
                                                <?php foreach($tipos as $tipo){?>
                                                        <option value="<?php echo $tipo['idtipoticket']?>"><?php echo $tipo['tipoticket']?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="estado" <?php echo ($gestionar->IDestado == 2)?'disabled':'';?>>
                                                <label class="form-check-label" for="exampleCheck1">Cerrar ticket</label>
                                        </div>
                                        <div class="center-button">
                                            <button class="btn btn-danger" type="submit" onclick="cancelar(); return false;">Cancelar</button>
                                            <button type="submit" id="boton" class="btn btn-primary" <?php echo ($gestionar->IDestado == 2)?'disabled':'';?>>Guardar</button>
                                        </div>
                                        <div class="alert alert-danger" role="alert" id="alert">
                                            
                                        </div>
                                    </form>
                                </div>
                                <div id="trazabilidad" class="container tab-pane fade"><br>
                                    <div id="trazabilidad">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </div>
        </article>
    </section>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $("#alert").hide();
        let activo;
        $("#boton").click(function(){
            let com = $("#comentarios").val();
            let select = $("#importancia").val();
            let tipo = $("#tipo").val();
            var activo = $("#estado").is(":checked");
                if (com == '' || select == '' || tipo == ''){
                    $("#alert").text("Campos obligatorios");
                    $("#alert").show();
                }else{
                    guardarnota(com,select,activo,tipo);
                }
                return false;
        });
    
    });
    
    function guardarnota(com,select,activo,tipo){
        $.ajax({
            method: "post",
            url: "ajax/guardarnota.php",
            data: {
                "comajax":com ,
                "selectajax": select,
                "tipoajax": tipo,
                "activoajax": activo,
                "ajaxticket":"<?php echo $ticket ?>"
            },
            success: function(data) {
                gestionticket(data);
            }
        });
    }

    function cancelar() {
        $.ajax({
            method: "post",
            url: "bandejaticket.php",
            data: {},
            success: function(data) {
                $("#content").html(data)
            }
        });
    }
 
    function consultanotas() {
        $.ajax({
            method: "post",
            url: "ajax/notas.php",
            data: {
                "ajaxticket":"<?php echo $ticket ?>"
            },
            success: function(data) {
                $("#trazabilidad").html(data)
            }
        }); 
    }
    consultanotas();

    function gestionticket(value) {
        $.ajax({
            method: "post",
            url: "gestticket.php",
            data: {
                "ajaxticket": value
            },
            success: function(data) {
                $("#content").html(data)
            }
        })
    }

</script>