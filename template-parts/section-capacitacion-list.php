<?php

$modalidad_txt = "Sincrónicas";
$is_list = false;
$show_title = true;

$args_query = array();

if (array_key_exists('modalidad', $args)) {
    if ($args['modalidad'] == 'asincronico') $modalidad_txt = "Asincrónicas";

    $args_query = array(
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'meta_key'       => '_cpc_capacitacion_field_modalidad',
        'meta_value'     => $args['modalidad'],
    );
}

if (array_key_exists('all', $args) && $args['all']) {
    $is_list = true;

    $args_query = array(
        'post_type'      => 'product',
    );
}

if (array_key_exists('title', $args)) {
    $show_title = $args['title'];
}

if (array_key_exists('add', $args)) {
    $addons = $args['add'];

    foreach ($addons as $add => $value) {
        $args_query[$add] = $value;
    }
}

$loop = new WP_Query($args_query);
$count = $loop->found_posts;

$args['count'] = $count;

?>

<section class="cpc_cursos_list <?php if (isset($args['class']['section'])) echo $args['class']['section']; ?>">
    <div class="container">
        <?php

        if ($is_list) {
        } else {

            if ($show_title) {
        ?>
                <div class="row cpc_cursos_header">
                    <div class="col col-lg-6">
                        <p class="cpc_title sm">Capacitaciones</p>
                        <p class="cpc_title"><?php echo $modalidad_txt; ?></p>
                        <hr class="cpc_hr mx-auto mx-lg-none">
                    </div>
                    <div class="col col-lg-6 d-flex align-items-center justify-content-end">
                        <p class="text text-center text-lg-end mx-auto mx-lg-none">
                            <?php


                            if (array_key_exists('modalidad', $args)) {
                                if ($args['modalidad'] == 'asincronico') {
                                    echo 'Estudia donde sea y cuando quieras, con nuestras clases en modalidad asincronica. Directo desde nuestra plataforma.';
                                }else{
                                    echo 'Estudia donde sea y cuando quieras, con nuestras clases en modalidad online en vivo. Directo desde nuestra plataforma.';
                                }
                            }

                            ?>
                        </p>
                    </div>
                </div>

        <?php
            }
        }


        ?>

        <div class="cpc_card_c <?php if ($count == 1) echo 'cpc_card_c_one '; ?>mt-5">
            <?php

            $post_in_id = array();
            $position_post = 0;
            if ($loop->have_posts()) {
                while ($loop->have_posts()) : $loop->the_post();
                    $position_post += 1;
                    $args['position_post'] = $position_post;

                    if (array_key_exists('near', $args) && $args['near']) {

                        $fechas = get_post_meta(get_the_ID(), '_cpc_capacitacion_field_modalidad_fechas', true);
                        $fechas_conditional = !empty($fechas);

                        if ($fechas_conditional) {
                            $fechas = json_decode($fechas, true);

                            $date_now = date('Y-m-d');
                            $date_compare = date('Y-m-d', strtotime($fechas[0]));

                            if ($date_now > $date_compare) {
                                //the date it past
                                $args['count'] = $args['count'] - 1;
                                $count = $args['count'];
                                cpc_capacitacion_change_asincronico(get_the_ID());
                            } else {
                                //Has to show
                                $post_in_id[] = get_the_ID();
                            }
                        } else {
                            // Fechas its empty
                            $args['count'] = $args['count'] - 1;
                            $count = $args['count'];
                        }
                    } else {
                        get_template_part('template-parts/cpt/block', 'cpt-item', $args);
                    }
                endwhile;
            }

            if (count($post_in_id) > 0) {
                $args_query['post__in'] = $post_in_id;

                $loop = new WP_Query($args_query);
                $count = $loop->found_posts;

                $args['count'] = $count;

                if ($loop->have_posts()) {
                    while ($loop->have_posts()) : $loop->the_post();
                        get_template_part('template-parts/cpt/block', 'cpt-item', $args);
                    endwhile;
                }
            }

            if ($count == 0) {
            ?>

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <p class="text-center d-flex flex-column justify-content-center align-middle align-items-center gap-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="163" height="164" fill="none" viewBox="0 0 163 164">
                                    <path fill="#097AC0" d="M81.41 10.387h-.065c-27.965 0-50.718 8.202-50.718 18.15v18.129c.06.458.127.803.188 1.155h.035c2.178 9.245 23.874 16.556 50.449 16.577h.158c26.575 0 48.271-7.332 50.448-16.577h.036c.061-.352.127-.697.188-1.155v-18.13c.005-9.947-22.754-18.149-50.718-18.149z" />
                                    <path fill="#097AC0" d="M117.124 73.989a42.374 42.374 0 0115.168 2.691c0-.152.081-.305.092-.463V58.069a6.38 6.38 0 00-.387-2.162c-2.59 8.187-19.996 14.623-42.394 15.885-2.651.142-5.343.234-8.1.234-2.758 0-5.45-.092-8.1-.234-22.389-1.262-39.805-7.698-42.395-15.885a6.358 6.358 0 00-.381 2.162v18.155c.574 9.728 22.8 17.6 50.199 17.696a44.312 44.312 0 015.988-7.525 41.571 41.571 0 0130.31-12.405z" />
                                    <path fill="#0F3249" d="M77.01 101.464c-1.262-.041-2.544-.041-3.766-.122-22.265-1.308-39.565-7.729-42.17-15.89a6.107 6.107 0 00-.381 2.096v18.149c.508 8.92 19.416 16.308 43.788 17.503a46.318 46.318 0 01-.606-5.851 45.51 45.51 0 013.135-15.885z" />
                                    <path fill="#097AC0" d="M76.364 130.874c-.967-.041-1.95-.031-2.89-.092-22.25-1.287-39.591-7.708-42.17-15.87a6.112 6.112 0 00-.387 2.097v18.144c.58 9.759 23.074 17.701 50.713 17.701 3.689 0 7.28-.152 10.746-.422a43.333 43.333 0 01-16.028-21.558h.016zm40.76-49.253a35.616 35.616 0 100 71.232 35.616 35.616 0 000-71.232zm23.986 56.035h-13.118a1.948 1.948 0 01-1.699-.809c-3.027-3.562-6.106-7.123-9.159-10.685-3.124 3.638-6.227 7.246-9.306 10.858a1.413 1.413 0 01-1.206.646H92.014c.815-.966 1.527-1.816 2.265-2.676.264-.315.626-.209.946-.209 1.526 0 3.053-.05 4.58 0a2.033 2.033 0 001.979-.885c.459-.61.95-1.196 1.47-1.755h-6.482c.758-.911 1.394-1.659 2.01-2.427.285-.346.666-.28 1.043-.28 1.557 0 3.119-.056 4.676 0a1.892 1.892 0 001.806-.84c.427-.585.931-1.114 1.526-1.796h-6.197a3.911 3.911 0 013.694-2.824h2.508c2.835 0 2.906-.04 4.534-2.63h-6.386l2.163-2.544c.259-.311.631-.214.956-.214h5.022c.601 0 1.863-.936 1.852-1.353-.01-.418-1.292-1.334-1.877-1.339-1.526 0-3.053-.051-4.579 0a2.031 2.031 0 01-2-.926c-.412-.585-.941-1.114-1.526-1.801h6.548c-.743-.885-1.369-1.598-1.954-2.34-.28-.357-.641-.316-1.017-.316-1.527 0-3.053-.046-4.58 0a2.085 2.085 0 01-2.01-.89c-.417-.585-.946-1.13-1.526-1.837h6.503c-.835-.982-1.491-1.755-2.148-2.514-.259-.305-.63-.213-.961-.213-1.527 0-3.053-.056-4.58 0a2.036 2.036 0 01-1.984-.942c-.392-.585-.895-1.068-1.46-1.755h6.482l-2.152-2.498c-.26-.306-.631-.183-.962-.183-1.557 0-3.119-.041-4.676 0a1.76 1.76 0 01-1.7-.774 25.036 25.036 0 00-1.643-1.949c.122-.31.392-.173.565-.173h13.697a1.672 1.672 0 011.405.692c3.052 3.593 6.146 7.164 9.27 10.797 2.788-3.236 5.597-6.39 8.268-9.667a4.362 4.362 0 013.964-1.862c4.223.168 8.446.05 12.883.05a1192.07 1192.07 0 00-4.579 5.384c-4.117 4.793-8.223 9.591-12.38 14.358-.57.662-.224.972.163 1.42 5.567 6.472 11.128 12.949 16.832 19.599l-1.155.102z" />
                                </svg>

                                No se han encontrado capacitaciones
                            </p>
                        </div>
                    </div>
                </div>

            <?php
            }

            wp_reset_query();
            ?>
        </div>

        <?php

        if ($count >= 1) {
            if (!$is_list) {
                $modalidad = $args['modalidad'];

        ?>
                <a href="<?php echo esc_url(get_term_link($modalidad, 'modalidad')); ?>" class="btn cpc_btn d-block mt-3 link-primary">Ver Todo Ahora</a>
        <?php
            }
        }
        ?>

    </div>
</section>

<?php wp_reset_query();  ?>