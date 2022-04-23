<div class="container">
    <div class="cpc_mewsletter">
        <div class="row">
            <div class="col-12 col-lg-7 mb-4 mb-lg-0">
                <div class="cpc_mewsletter_text">
                    <h3 class="cpc_title">Envianos tu email para acceder a nuestras promociones</h3>
                    <p class="sub">Recibe nuestras promociones y noticias</p>
                    <span class="info">Al enviar su correo está aceptando <a href="">nuestros términos y cóndiciones</a></span>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="cpc_mewsletter_form">
                    <form action="">
                        <input type="email" class="cpc_input" id="exampleInputEmail1" placeholder="Ingrese su correo ejemplo@correo.com">
                        <button type="submit" class="btn btn-primary d-block w-100">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<footer>
    <div class="container">
        <div class="cpc_footer_i img">
            <img src="<?php echo get_site_icon_url() ?>" alt="">
        </div>
        <div class="cpc_footer_i">
            <a href="">Cursos en vivo <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            <a href="">Cursos asincronicos <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="cpc_footer_i">
            <a href="">Eventos <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            <a href="">Campus Virtual <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
</footer>


<?php

get_template_part('template-parts/modal', 'login-register');


wp_footer();

?>

<script>
    
</script>


</body>

</html>