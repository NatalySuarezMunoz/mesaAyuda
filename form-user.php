<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$IDempleado = $_POST['IDempleado'];

?>

<script type="text/javascript">
    $(document).ready(function() {
        if (<?php echo $IDempleado; ?> === 0) {
            $("#titulo").text("Nuevo Usuario");
            $("#ingresaruser").text("Crear Usuario");
        } else {
            $("#titulo").text("Editar Usuario");
            $("#ingresaruser").text("Guardar");
        }

        $("#formulario").submit(function(e){
            crear(); 
            e.preventDefault();
        })
    });

    function crear() {
        $.ajax({
            method: "post",
            url: "ajax/adduser.php",
            data: $("#formulario").serialize(),
            dataType: "json",
            success: function(data) {
                cancelar();
            }
        });
    }

    function cancelar() {
        $.ajax({
            method: "post",
            url: "gestuser.php",
            data: {},
            success: function(data) {
                $("#content").html(data)
            }
        });
    }
</script>

<div>
    <section>
        <article class="section-content-page diametro">
            <h3 id="titulo">Editar Usuario</h3>

            <form method="POST" id="formulario" name="formulario">
                <div class="user-form">
                    <section>
                        <article>
                            <div>
                                <section>
                                    <article>
                                        <span>Nombre</span>
                                        <div>
                                            <input name="nombre" type="text" class="form-control form-control-name" aria-describedby="sizing-addon1" required>
                                        </div>
                                    </article>
                                </section>
                            </div>

                            <div>
                                <section>
                                    <article>
                                        <span>Documento</span>
                                        <input name="document" type="text" class="form-control" aria-describedby="sizing-addon1" required>
                                    </article>
                                    <article>
                                        <span>Genero</span>

                                        <select name="genero" class="form-control" required>
                                            <option value="masculino">Masculino</option>
                                            <option value="femenino">Femenino</option>
                                        </select>
                                    </article>
                                </section>
                            </div>

                            <div>
                                <div><span>Cargo</span></div>

                                <div class="form-check">
                                    <select name="cargo" class="form-control" required>
                                        <option value="1">Desarrollador</option>
                                        <option value="2">Analista</option>
                                    </select>
                                </div>
                          
                            </div>
                        </article>

                        <div class="vertical-line"></div>

                        <article>
                            <div>       
                                <section>
                                    <article>
                                        <span>Correo Electronico</span>
                                        <input name="email" type="email" class="form-control" aria-describedby="sizing-addon1" required>
                                    </article>
                                </section>
                            </div>

                            <div>
                                <section>
                                    <article>
                                        <span>Password</span>
                                        <input name="password" type="password" class="form-control" aria-describedby="sizing-addon1" required>
                                    </article>
                                    <article>
                                        <span>Confirmar Password</span>
                                        <input name="confirm_password" type="password" class="form-control" aria-describedby="sizing-addon1" required>
                                    </article>
                                </section>
                            </div>

                            <div class="chek">
                                <input name="admin" type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">¿Es un usuario administrador?</label>
                            </div>
                        </article>
                    </section>
                </div>

                <div class="new">
                    <button class="btn-gris" type="submit" onclick="cancelar(); return false;">Cancelar</button>
                    <button id="ingresaruser" class="btn-gris" type="submit" name="ingresaruser">Crear Usuario</button>
                </div>
            </form>
        </article>
    </section>
</div>