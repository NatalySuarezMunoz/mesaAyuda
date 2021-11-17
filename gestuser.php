<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

// include 'bd/bd.php';
// $bd=new bd();

// $sql="SELECT * FROM empleado";
// $resultado=$bd->consultar($sql);  
// $usuarios=array();
// while ($fila=$resultado->fetch_array(MYSQLI_ASSOC)) {
//     array_push($usuarios,$fila);
// }
/* echo '<pre>'; como imprimir un arreglo 
print_r($usuarios);
echo '</pre>'; */
include 'lib/head.php';
?>
<div>
    <section>
        <article class="section-content-page diametro">
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
                                    <th scope="col">correo</th>
                                    <th scope="col">cargo</th>
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
     $(document).ready(function(){
               lista('');
               $("#search").keyup(function(){
                   let letra=$(this).val();
                   if(letra.length>4){
                    lista(letra);
                   }
               });
           });
           function lista(nombre){
               $.ajax({
                   method: "post",
                   url: "ajax/lista.php",
                   data: {"nombreAjax":nombre},
                   success: function(value){
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
            }
        })
    }
</script>
<?php
include 'lib/footer.php';
?>