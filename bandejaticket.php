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
                                <th scope="col">Cliente</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Gestionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Brayan Villarraga</td>
                                <td>1023950480</td>
                                <td>bsvillarraga</td>
                                <td>bsvilalrraga@helpdesk.com</td>
                                <td><a><img src="../img/edit-icon.png" onclick="editTicket(1);return false;" /></a></td>
                            </tr>
                            <tr>
                                <td>Brayan Villarraga</td>
                                <td>1023950480</td>
                                <td>bsvillarraga</td>
                                <td>bsvilalrraga@helpdesk.com</td>
                                <td><a><img src="../img/edit-icon.png" onclick="editTicket(2);return false;"/></a></td>
                            </tr>
                            <tr>
                                <td>Brayan Villarraga</td>
                                <td>1023950480</td>
                                <td>bsvillarraga</td>
                                <td>bsvilalrraga@helpdesk.com</td>
                                <td><a><img src="../img/edit-icon.png" onclick="editTicket(3);return false;"/></a></td>
                            </tr>
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
    function editTicket(value) {
        $.ajax({
            method: "post",
            url: "gestticket.php",
            data: {
                "IDempleado": value
            },
            success: function(data) {
                $("#content").html(data)
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
</script>