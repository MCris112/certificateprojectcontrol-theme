<?php


?>

<section class="cpc_section_title cpc_near_menu_top">
    <div class="cpc_bg_section">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/backgrounds/bg_product.jpg" alt="">
        <div class="cover"></div>
    </div>
    <div class="container">
        <div class="cpc_content">
            <h1 class="cpc_mega_title"><?php echo $args['title']; ?></h1>

            <?php
            
            if(array_key_exists('subtitle', $args)) {
            ?>
                <h2 class="cpc_subtitle"><?php echo $args['subtitle']; ?></h2>
            <?php
            }
            ?>
        </div>
    </div>
</section>