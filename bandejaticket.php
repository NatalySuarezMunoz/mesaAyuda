<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);

$marca = $_SESSION['nombre'];

?>
<div>
    <section>
        <article class="section-content-page diametro">
            <div>
                <section class="display-inline">
                    <article>
                        <h3>Bienvenido a HELP DESK <?php echo ucfirst(strtolower($marca)) ?> <br> Bandeja Ticket</h3>
                    </article>
                </section>
            </Div>
            <h4 class="subtitulo">Consulte el estado de los ticket que actualmente tiene en su bandeja</h4>

            <form>
                <div class="search">
                    <input type="text" class="form-control" name="casos" id="search" placeholder="Busque por n&uacute;mero o cliente" aria-describedby="sizing-addon1">
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
    $(document).ready(function(){
        ticketlista('');
        $("#search").keyup(function(){
            let letra=$(this).val();
            ticketlista(letra);
        });
    });
        function ticketlista(ticket){
            $.ajax({
                method: "post",
                url: "ajax/listarticket.php",
                data: {"ticketAjax":ticket},
                success: function(value){
                    $("#viewlist").html(value);
                }
            })
        }

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