<?php 

$search = isset( $_GET["s"] ) ? $_GET["s"] : "" ;  
?>

<form role="search" method="get" id="searchform" class="cpc_btn_pc d-none d-xl-flex" action="<?php echo home_url( '/' ); ?>">
    <input class="form-control" type="search" placeholder="Buscar..." aria-label="Buscar..." value="<?php echo $search;?>" name="s" id="s">
    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
</form>