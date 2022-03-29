jQuery(document).ready(function() {
    cpc_field_datepicker_activate_func();

    cpc_field_temario_show_values();

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


function cpc_field_temario_show_item(temario_item_id, temario_item_id_collapse, temario_item_id_title, values = {title: null, content: null}){
    const cpc_editor_settings ={
        tinymce: true,
        mediaButtons: false,
        quicktags: true
    }

    $input_val = values[title] == null ? '' : "value='"+values[title]+"'";

    $item_html = '<div class="accordion-item">'+
                    '<h2 class="accordion-header" id="headingOne">'+
                        '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#'+temario_item_id_collapse+'" aria-expanded="false" aria-controls="'+temario_item_id_collapse+'">'+
                            '<input type="text" class="form-control" id="'+temario_item_id_title+'" placeholder="Módulo" name='+temario_item_id_title+' '+$input_val+'>'+
                        '</button>'+
                    '</h2>'+
                    '<div id="'+temario_item_id_collapse+'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#cpcTemarioContainer">'+
                        '<div class="accordion-body">'+
                            '<textarea id="'+temario_item_id+'" name="'+temario_item_id+'" rows="5">'+values[content]+'</textarea>'+
                        '</div>'+
                    '</div>'+
                '</div>';
    jQuery('#cpcTemarioContainer').append($item_html);
    wp.editor.initialize( temario_item_id ,cpc_editor_settings );
}
function cpc_field_temario_get_values(){
    var temario = jQuery('#_cpc_capacitacion_field_temario').val();

    if(temario == ''){
        temario = [];
    }else{
        try{
            temario = JSON.parse(temario);
        }catch(e){
            temario = "no";
        }
    }

    if(!Array.isArray(temario)){
        var options = [];
        var myModal = new bootstrap.Modal(document.getElementById('cpcModalResetValue'), options);
        myModal.show();
        
        return [];
    }

    return temario;
}
function cpc_field_temario_show_values(){
    //foreach of var values in value array js

    var temario = cpc_field_temario_get_values();

    jQuery.each(temario, function(index, value) {
        var post_id = jQuery('#post_ID').val();
        var url = document.getElementById('site_url').value;

        var ajax_url = url+'/wp-admin/admin-ajax.php';
        data_title_val = value+'_title';

        var data = {
            'action': 'cpc_post_meta',
            'post_id': post_id,
            'meta_keys': {
                'title': data_title_val,
                'content': value
            }
        }

        console.log(ajax_url);
        console.log(data);

        jQuery.ajax({
            url : ajax_url,
            type: "POST",
            data: data,
            success: function(response) {
                console.log(response);

                values = {
                    title: response[data_title_val],
                    content: response[value]
                };
                
                
                const temario_item_id_collapse = value+"_collapse";
                const temario_item_id_title = value+"_title";

                cpc_field_temario_show_item(value, temario_item_id_collapse, temario_item_id_title, values);
            }
        });

        
    });
}


function cpc_field_temario_add_item(){

    var temario = cpc_field_temario_get_values();

    const temario_item_id = "_cpc_capacitacion_field_temario_item_"+Date.now();
    const temario_item_id_collapse = temario_item_id+"_collapse";
    const temario_item_id_title = temario_item_id+"_title";

    cpc_field_temario_show_item(temario_item_id, temario_item_id_collapse, temario_item_id_title);
    

    temario.push(temario_item_id)
    jQuery('#_cpc_capacitacion_field_temario').val( JSON.stringify(temario) );

}

function cpc_field_temario_reset(){
    jQuery('#_cpc_capacitacion_field_temario').val('');
}