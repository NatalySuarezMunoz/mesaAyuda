<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

include 'lib/head.php';
?>
        <div class="content-login">
            <section class="login">
                <article>
                    <div class="logo">
                        <img src="img/logo_login.png">
                    </div>                    
                </article>
    
                <article>
                    <div class="form">
                        <div class="icon-computer">
                            <img src="img/img_computer_login.png"/>
                        </div>
                        
                        <div class="container"> 
                            <form method="POST">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="email" class="form-control" name="user" placeholder="user" id="user" aria-describedby="sizing-addon1" required>
                                </div>

                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="password" id="password" aria-describedby="sizing-addon1" required>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="form-group">
                                        <button class="btn-gris" type="submit" id="boton">Entrar</button>
                                     </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="form-group">
                                         <div class="alert alert-danger" id="alert">

                                         </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </article>
            </section>
        </div>        

    <script type="text/javascript">
        $(document).ready(function(){
            $("#alert").hide();//hide oculta elementos html
               $("#boton").click(function(){
                  let user= $("#user").val();
                  let password= $("#password").val();
                  lista(user,password);
                  return false;
               });
           });

           function lista(user,password){
               $.ajax({
                   method: "post",
                   url: "ajax/ingreso.php",
                   data: {
                       "userAjax":user,
                       "passwordAjax":password
                    },
                   success: function(retornojson){
                     if (retornojson.error == false){
                        window.location.href = retornojson.accion;
                        alert(retornojson);
                     }
                     else{
                        $("#alert").text(retornojson.accion);
                        $("#alert").show();
                     }
                   }
               })
           }
        //    function pageRedirect() {
        //     window.location.href = "index.php";
        // }
    </script>
<?php
include 'lib/footer.php';
?>