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

            <div id="menuppal" class="menu">
                <ul>
                    <li class="option-menu active-menu" onclick="menuClick('bandejaticket.php'); return false;">
                        <a>
                            <div>
                                <span>Bandeja Ticket</span>
                                <i class="arrow right"></i>
                            </div>
                        </a>
                    </li>
                    <li class="option-menu"  onclick="menuClick('gestuser.php'); return false;">
                        <a>
                            <div>
                                <span>Gestionar Usuarios</span>
                                <i class="arrow right"></i>
                            </div>
                        </a>
                    </li>
                    <li class="option-menu" onclick="pageRedirect();">
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
            <div id="content"></div>
        </article>
    </section>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadPageDefault();
    });

    function loadPageDefault() {
        var menu = document.getElementById("menuppal");
        var options = menu.getElementsByClassName("option-menu");

        for (var i = 0; i < options.length; i++) {
            options[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active-menu");
                current[0].className = current[0].className.replace(" active-menu", "");
                this.className += " active-menu";
            });
        }

        options[0].click();
    }

    function menuClick(page) {
        $.ajax({
            method: "post",
            url: page,
            data: {
                "pageppal": page
            },
            success: function(data) {
                $("#content").html(data)
            }
        })
    }

    function pageRedirect() {
        window.location.href = "login.php";
    }  
</script>


<?php
include 'lib/footer.php';
?>