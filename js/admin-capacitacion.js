jQuery(document).ready(function() {
    cpc_field_datepicker_activate_func();

    jQuery('#cpc_capacitacion_field_modalidad').on('change', function() {
        cpc_field_datepicker_activate_func();
    });
});

function cpc_field_datepicker_activate_func(){
    if(jQuery('#cpc_capacitacion_field_modalidad').val() == 'true'){
        jQuery("#cpc_field_datepicker_container").show();
        jQuery(".cpc_field_datepicker").datepicker({
            dateFormat: "dd-mm-yy",
        });
    }else{
        jQuery("#cpc_field_datepicker_container").hide();
    }
    
}