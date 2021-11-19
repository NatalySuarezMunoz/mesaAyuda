<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);

$marca = $_SESSION['nombre'];
 include 'bd/bd.php';
 $bd=new bd();

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
$fechaInicio = date("Y-m-d H:i:s");

//include 'lib/head.php';
?>
<form action="" method="post" name="formulario" id="formulario">
<div>
    <section class="section-flex">
        <article class="section-content-page diametro">

            <div class="user-form">
                <section>
                    <article>
                        <div class="body-details-ticket">
                                <div>
                                    <section class="display-inline">
                                        <article>
                                             <h3>Bienvenido/a a HELP DESK <?php echo $marca?> <br> Crear Nuevo Ticket</h3>
                                        </article>
                                    </section>
                                </Div>
                                <div>
                                    <section>
                                        <article>
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Fecha de inicio</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <input type="text" value="<?php echo $fechaInicio?>" name="fechaini" class="edit-ticket-field" id="fechainicio" required>
                                                </article>
                                            </section>
                                        </article>
                                    </section>
                                </div>

                                <div>
                                    <section>
                                        <article>
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Titulo</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <input type="text" name="titulo" class="edit-ticket-field" id="titulo" required>
                                                </article>
                                            </section>
                                        </article>
                                    </section>
                                </div>
                                <div class="ddlselection">
                                    <section>
                                        <article>
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Importancia</span>
                                                    </div>
                                                </article>
                                                <article>
                                                <div class="form-check">
                                                    <select name="importancia" class="form-control" id="importancia" required>
                                                        <option value="">Seleccione</option>
                                                    <?php foreach($importancias as $importancia){?>
                                                        <option value="<?php echo $importancia['idimportancia']?>"><?php echo $importancia['importancia']?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                                </article>
                                            </section>
                                        </article>
                                        <article class="align-left>
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Tipo</span>
                                                    </div>
                                                </article>
                                                <article>
                                                <div class="form-check">
                                                    <select name="tipoticket" class="form-control" id="tipoticket" required>
                                                    <option value="">Seleccione</option>
                                                    <?php foreach($tipos as $tipo){?>
                                                        <option value="<?php echo $tipo['idtipoticket']?>"><?php echo $tipo['tipoticket']?></option>
                                                    <?php } ?>
                                                    </select>
                                                </div>
                                                </article>
                                            </section>
                                        </article>
                                    </section>
                                </div>

                                <textarea rows="5" name="descripcion" class="textarea-margin" required></textarea>

                                <input class="input-file" type="file" name="file">

                                <div class="center-button">
                                    <button class="btn-gris" type="submit" onclick="cancelar(); return false;" id="cancelar">Cancelar</button>
                                    <button class="btn-gris" type="submit" id="crear" name="crear">Crear Ticket</button>
                                </div>
                        </div>
                    </article>
                </section>
            </div>
        </article>
    </section>
</div>
</form>
<script type="text/javascript">
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

    $(document).ready(function() {
        $("#formulario").submit(function(e){
            crear(); 
            e.preventDefault();
        })
    });

    function crear() {
        $.ajax({
            method: "post",
            url: "ajax/crearticket.php",
            data: $("#formulario").serialize(),
            dataType: "json",
            success: function(data) {
                cancelar();
            }
        });
    }
</script>
<?php
//include 'lib/footer.php';
?>