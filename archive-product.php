<?php

get_header();

if(is_tax()){
    get_template_part('template-parts/cpt/view', 'taxonomy');
}else{
    get_template_part('template-parts/cpt/view', 'archive');
}
?>


<?php

get_template_part('template-parts/section', 'ponentes');

get_footer();
?>