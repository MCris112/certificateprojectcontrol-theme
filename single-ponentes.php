<?php
get_header();

get_template_part('template-parts/section', 'title');


?>
<section class="cpc_ponentes_section">
    <div class="container">
        <div class="row">
            <div class="col col-md-6">
                <div class="cpc_ponente_ball">
                    <div class="img">
                        <?php if (has_post_thumbnail()) {
                            echo '<img src="' . get_the_post_thumbnail_url() . '" alt="">';
                        } else {
                            echo '<img src="' . get_template_directory_uri() . '/assets/images/ponentes/ponente-unknow-img.jpg" alt="Certificate Project Control No ahay ponetnes">';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col col-md-6">
                <h2 class="cpc_title"><?php the_title(); ?></h2>
                <hr class="cpc_hr">

                <p><svg xmlns="http://www.w3.org/2000/svg" width="38" height="42" fill="none" viewBox="0 0 38 42">
                        <g clip-path="url(#a)">
                            <path fill="#0C417A" d="m32.72 16.125 4.558 4.16-6.41 1.696 1.52 5.533-6.03-1.171 4.843 13.125c0 .888-.443 1.588-1.33 2.1l-2.468-2.1-2.943 2.503c-.696-.134-1.266-.437-1.71-.908-.442-.471-.664-1.003-.664-1.596L19 31.148l-3.038 8.32c0 .592-.221 1.124-.665 1.595-.443.47-1.012.774-1.709.908l-2.943-2.503-2.469 2.1c-.886-.512-1.329-1.212-1.329-2.1l4.842-13.125-6.029 1.17 1.52-5.532-6.41-1.696 4.558-4.16-4.557-4.16 6.408-1.655L5.66 4.777l6.504 1.293L14.111.618 19 4.495 23.89.618l1.993 5.452 6.504-1.293-1.52 5.533 6.41 1.656-4.558 4.16ZM19.024 8.371c-2.516 0-4.668.761-6.456 2.282-1.788 1.521-2.683 3.352-2.683 5.492s.895 3.972 2.683 5.493c1.788 1.52 3.94 2.281 6.456 2.281 2.516 0 4.668-.76 6.456-2.281 1.789-1.521 2.683-3.352 2.683-5.493 0-2.14-.894-3.97-2.683-5.492-1.788-1.521-3.94-2.282-6.456-2.282Z" />
                        </g>
                        <defs>
                            <clipPath id="a">
                                <path fill="#fff" d="M0 0h36.507v41.354H0z" transform="translate(.77 .618)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <?php echo cpc_get_meta_field('_cpc_ponentes_meta_box_certificados_key'); ?></p>
                <p><?php echo cpc_get_meta_field('_cpc_ponentes_meta_box_subtitle_key'); ?></p>
                <p><?php echo cpc_get_meta_field('_cpc_ponentes_meta_box_desc_key'); ?></p>
            </div>
        </div>
    </div>
</section>

<?php

get_footer();
?>