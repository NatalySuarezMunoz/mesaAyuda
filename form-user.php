<?php
$IDempleado = $_POST['IDempleado'];

error_reporting(E_ALL);
ini_set('display_errors',1);

include 'bd/bd.php';
$bd=new bd();

if (isset($_POST['ingresaruser'])){
    echo 'usuario ingresado';
    $nombre=$_POST['nombre'];
    $documento=$_POST['document'];
    $genero=$_POST['genero'];
    $cargo=$_POST['cargo'];
    //echo 
    //exit;
    echo $sql="INSERT INTO empleado (nombre,documento,IDcargo,genero) VALUES ('".$nombre."', '".$documento."', '".$cargo."', '".$genero."')";
    $resultado=$bd->insertar($sql);
}

?>

<script type="text/javascript">
    $(document).ready(function() {
        if (<?php echo $IDempleado; ?> === 0) {
            $("#titulo").text("Nuevo Usuario");
            $("#btnAccion").text("Crear Usuario");
        } else {
            $("#titulo").text("Editar Usuario");
            $("#btnAccion").text("Guardar");
        }
    });

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

            <form method="POST">
                <div class="user-form">
                    <section>
                        <article>
                            <div>
                                <section>
                                    <article>
                                        <span>Nombre</span>
                                        <div>
                                            <input name="nombre" type="text" class="form-control form-control-name" aria-describedby="sizing-addon1">
                                        </div>
                                    </article>
                                </section>
                            </div>

                            <div>
                                <section>
                                    <article>
                                        <span>Documento</span>
                                        <input name="document" type="text" class="form-control" aria-describedby="sizing-addon1">
                                    </article>
                                    <article>
                                        <span>Genero</span>

                                        <select name="genero" class="form-control">
                                            <option value="masculino">Masculino</option>
                                            <option value="femenino">Femenino</option>
                                        </select>
                                    </article>
                                </section>
                            </div>

                            <div>
                                <div><span>Cargo</span></div>

                                <div class="form-check">
                                    <select name="cargo" class="form-control">
                                        <option value="1">Desarrollador</option>
                                        <option value="2">Analista</option>
                                    </select>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Facturación
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Contabilidad
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Recursos Humanos
                                    </label>
                                </div>
                            </div>
                        </article>

                        <div class="vertical-line"></div>

                        <article>
                            <div>
                                <section>
                                    <article>
                                        <span>Correo Electronico</span>
                                        <input name="email" type="email" class="form-control" aria-describedby="sizing-addon1">
                                    </article>
                                    <article>
                                        <span>Usuario</span>
                                        <label id="lblusuario" class="form-control">Textyo</label>
                                    </article>
                                </section>
                            </div>

                            <div>
                                <section>
                                    <article>
                                        <span>Password</span>
                                        <input name="password" type="password" class="form-control" aria-describedby="sizing-addon1">
                                    </article>
                                    <article>
                                        <span>Confirmar Password</span>
                                        <input name="confirm_password" type="password" class="form-control" aria-describedby="sizing-addon1">
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
                    <button id="btnAccion" class="btn-gris" type="submit" name="ingresaruser">Crear Usuario</button>
                </div>
            </form>
        </article>
    </section>
</div>