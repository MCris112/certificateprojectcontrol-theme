<div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
    <div class="col p-4 d-flex flex-column position-static">
        <div class="d-flex">
            <?php
            
            $categories = get_the_category();

            foreach ($categories as $category){
                ?>
                <a href="<?php echo get_category_link($category->term_id)?>"><strong class="d-inline-block mb-2 text-primary me-2"><?php echo $category->name; ?></strong></a>
                <?php
            }
            
            ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="mb-0 text-decoration-none"><h3><?php the_title(); ?></h3></a>
        <div class="mb-1 text-muted"><?php the_date(); ?></div>

        <?php
        
        if(has_excerpt()){
            ?>
            <p class="card-text mb-auto"><?php echo get_the_excerpt(); ?></p>
            <?php
        }
        
        ?>
        <a href="<?php the_permalink(); ?>" class="link">Saber Más</a>
    </div>
    <div class="col-auto d-none d-lg-block">
        <?php
        
        if(has_post_thumbnail()){
            the_post_thumbnail('medium', array(
                'class' => 'img-fluid',
                'style' => 'height: 100%; object-fit: cover;'
            ));
        }else{
            ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/imges/default.jpg" class="img-fluid" alt="">
            <?php
        }
        
        ?>

    </div>
</div>