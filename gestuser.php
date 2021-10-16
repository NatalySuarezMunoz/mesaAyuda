<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'bd/bd.php';
$bd=new bd();

$sql="SELECT * FROM empleado";
$resultado=$bd->consultar($sql);  
$usuarios=array();
while ($fila=$resultado->fetch_array(MYSQLI_ASSOC)) {
    array_push($usuarios,$fila);
}
/* echo '<pre>'; como imprimir un arreglo 
print_r($usuarios);
echo '</pre>'; */
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
                    <h3>Gestionar Usuario</h3>
                    <form>
                        <div class="search">
                            <input type="text" class="form-control" name="user" placeholder="Busque por nombre, documento, usuario" id="user" aria-describedby="sizing-addon1">
                            <button class="btn-gris" type="submit">Buscar</button>                                              
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
                                 <tbody>
                                 <?php
                                    foreach($usuarios as $usuario){
                                 ?>
                                 <tr>
                                     <td><?php echo $usuario['IDempleado']?></td>
                                     <td><?php echo $usuario['nombre']?></td>
                                     <td><?php echo $usuario['documento']?></td>
                                     <td><?php echo $usuario['IDcargo']?></td>
                                     <td><?php echo $usuario['genero']?></td>
                                 </tr>
                                 <?php
                                 } 
                                 ?>
                                </tbody> 
                              </table>
                        </div>

                        <div class="new">
                            <button class="btn-gris" type="submit">Crear Usuario</button>
                        </div>
                    </form>                   
                </article>
            </section>
        </div>
        <script type="text/javascript">
           
        </script>
<?php
include 'lib/footer.php';
?>