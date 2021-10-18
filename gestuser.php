<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'lib/head.php';
?>
<div class="content-template">
    <section>
        <article>
            <div>
                <img class="logo" src="img/logo_login.png" />
            </div>

            <div class="menu">
                <ul>
                    <li>
                        <a>
                            <div>
                                <span>Bandeja Ticket</span>
                                <i class="arrow right"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div>
                                <span>Gestionar Usuarios</span>
                                <i class="arrow right"></i>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a>
                            <div>
                                <span>Cerrar Sesión</span>
                                <i class="arrow right"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </article>
        <article class="section-content diametro">
            <div id="gestuser">
                <h3>Gestionar Usuario</h3>
                <form>
                    <div class="search">
                        <input type="text" class="form-control" name="user" id="search" placeholder="Busque por nombre, documento, usuario" aria-describedby="sizing-addon1">
                        <!-- <button class="btn-gris" type="submit">Buscar</button>                                               -->
                    </div>

                    <div>
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Gestionar</th>
                                </tr>
                            </thead>
                            <tbody id="viewlist">

                            </tbody>
                        </table>
                    </div>

                    <div class="new">
                        <button class="btn-gris" type="submit" onclick="newUser(); return false;">Crear Usuario</button>
                    </div>
                </form>
            </div>

            <div id="content"></div>
        </article>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        lista('');
        $("#search").keyup(function() {
            let letra = $(this).val();
            if (letra.length > 4) {
                lista(letra);
            } else if (letra.length === 0) {
                lista("");
            }
        });
    });

    function lista(nombre) {
        $.ajax({
            method: "post",
            url: "ajax/lista.php",
            data: {
                "nombreAjax": nombre
            },
            success: function(value) {
                $("#viewlist").html(value);                
            }
        })
    }

    function edit(value) {
        $.ajax({
            method: "post",
            url: "form-user.php",
            data: {
                "IDempleado": value
            },
            success: function(data) {
                $("#content").html(data)
                $("#gestuser").hide();
            }
        })
    }

    function newUser() {
        $.ajax({
            method: "post",
            url: "form-user.php",
            data: {
                "IDempleado": 0
            },
            success: function(data) {
                $("#content").html(data)
                $("#gestuser").hide();
            }
        })
    }

    function cancelar() {
        $("#content").hide();
        $("#gestuser").show();
    }
</script>
<?php
include 'lib/footer.php';
?>