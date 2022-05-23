<?php 

$search = isset( $_GET["s"] ) ? $_GET["s"] : "" ;  
?>

<form role="search" method="get" id="searchform" class="d-none d-xl-flex" action="<?php echo home_url( '/' ); ?>">
    <div class="input-group">
        <input class="form-control" type="search" placeholder="Search" aria-label="Buscar..." value="<?php echo $search;?>" name="s" id="s">
        <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
    </div>
</form>