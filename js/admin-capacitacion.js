class CPC_TEMARIO{
    temario_input_id;
    temario;

    constructor(temario_input_id){
        this.temario_input_id = temario_input_id;
    }

    get_values(){
        var temario_c = jQuery(this.temario_input_id).val();

        if(temario_c == ''){
            this.temario = {};
        }else{
            try{
                this.temario = JSON.parse(temario_c);
            }catch(e){
                var options = {};
                var myModal = new bootstrap.Modal(document.getElementById('cpcModalResetValue'), options);
                myModal.show();
                return {};
            }
        }

        return this.temario;
    }

    update(values){
        this.temario = [];
        jQuery(this.temario_input_id).val( JSON.stringify(values) );
    }

    remove(remove_key){
        var values = this.get_values();
        var new_values = {};

        jQuery.each(values, function(key, val){
            if(key == remove_key){
                tinymce.editors[key].remove();
                jQuery('#'+key+"_accordion").remove();
            }else{
                new_values[key] = val;
            }
        });

        this.update(new_values);
    }
    add(key, value){
        var values = this.get_values();

        values[key] = value;
    
        var string_values = JSON.stringify(values);

        document.getElementById("_cpc_capacitacion_field_temario").value = string_values;
        //jQuery(this.temario_input_id).val( string_values );
    }

    reset(){
        this.temario = [];
        jQuery(this.temario_input_id).val( '[]' );
    }
}

const cpc_input_data_id = '#_cpc_capacitacion_field_temario';

jQuery(document).ready(function() {
    const cpc_temario = new CPC_TEMARIO(cpc_input_data_id);
    cpc_field_temario_show_values(cpc_temario.get_values());
});






function cpc_field_temario_show_item(temario_item_id, temario_item_id_collapse, temario_item_id_title, values = {title: 'Módulo', content: 'Contenido del módulo'}){
    const cpc_editor_settings ={
        tinymce: true,
        mediaButtons: false,
        quicktags: true
    }

    input_val = "value='"+values.title+"'";

    btn_trash = "cpc_field_temario_remove_item('"+temario_item_id+"');";

    $item_html = '<div class="accordion-item" id="'+temario_item_id+'_accordion">'+
                    '<h2 class="accordion-header" id="headingOne">'+
                        '<button class="accordion-button border border-primary" type="button" data-bs-toggle="collapse" data-bs-target="#'+temario_item_id_collapse+'" aria-expanded="false" aria-controls="'+temario_item_id_collapse+'">'+
                            '<div class="container-fluid"><div class="row"><div class="col">'+
                                '<input type="text" class="form-control" id="'+temario_item_id_title+'" placeholder="Módulo" name='+temario_item_id_title+' '+input_val+'>'+
                            '</div><div class="col d-flex justify-content-end">'+
                                '<div class="btn btn-danger"  onclick="'+btn_trash+'">'+
                                    '<i class="fa fa-trash fa-lg" aria-hidden="true""></i>'+
                                '</div>'+
                            '</div></div></div>'+
                        '</button>'+
                    '</h2>'+
                    '<div id="'+temario_item_id_collapse+'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#cpcTemarioContainer">'+
                        '<div class="accordion-body">'+
                            '<textarea id="'+temario_item_id+'" name="'+temario_item_id+'" rows="5">'+values.content+'</textarea>'+
                        '</div>'+
                    '</div>'+
                '</div>';
    jQuery('#cpcTemarioContainer').append($item_html);

    //Start the TextEditor
    wp.editor.initialize( temario_item_id ,cpc_editor_settings );

    temario_class = new CPC_TEMARIO(cpc_input_data_id);

    
    jQuery("#"+temario_item_id_title).on('change input', function() {
        var temario = temario_class.get_values();

        if(temario_item_id in temario){
            temario[temario_item_id]['title'] = jQuery("#"+temario_item_id_title).val();
        }

        temario_class.update(temario);
    });

    //Get the content of the texteditor and show it into the var array on input
    tinymce.editors[temario_item_id].on('change input', function() {
        var temario = temario_class.get_values();

        if(temario_item_id in temario){
            temario[temario_item_id]['content'] = tinymce.editors[temario_item_id].getContent();
        }

        temario_class.update(temario);
    });
}

function cpc_field_temario_show_values(values){
    //foreach of var values in value array js

    var temario = values;

   jQuery.each(temario, function(key, val){
        var value = {
            title: val.title,
            content: val.content
        };

        cpc_field_temario_show_item(key, key+'_collapse', key+'_title', value);
    });
}


function cpc_field_temario_add_item(){
    
    cpc_temario = new CPC_TEMARIO(cpc_input_data_id);

    const temario_item_id = "_cpc_capacitacion_field_temario_item_"+Date.now();
    const temario_item_id_collapse = temario_item_id+"_collapse";
    const temario_item_id_title = temario_item_id+"_title";

    var values = cpc_temario.get_values();

    values[temario_item_id] = {
        title: 'Módulo',
        content: 'Contenido del módulo'
    };
    /*
    values.push( key );

    jQuery(values).each(function(index, content){
        console.log(content ==  key);
        
        if(content ==  key) {
            values[content] = value;
        }
    });

    */

    var string_values = JSON.stringify(values);

    jQuery(cpc_input_data_id).val( string_values );
    /*
    cpc_temario.add(temario_item_id, {
        title: 'Módulo',
        content: 'Contenido del módulo'
    });
    */

    cpc_field_temario_show_item(temario_item_id, temario_item_id_collapse, temario_item_id_title);
    
    
}

function cpc_field_temario_on_change(temario_class, parent, type, input_id){
    var temario = temario_class.get_values();

    if(parent in temario){
        temario[parent][type] = jQuery(input_id).val();
    }

    temario_class.update(temario);
}

function  cpc_field_temario_reset(){
    cpc_temario = new CPC_TEMARIO(cpc_input_data_id);
    cpc_temario.reset();
}

function cpc_field_temario_remove_item(temario_item_id){

    console.log("ON CPCP FIELD TEMARIO REMOVE ITEM");
    cpc_temario_modal('¿Está seguro que desea eliminar este módulo/Elemento?', 
        'Eliminar módulo',
        function(){
            cpc_temario = new CPC_TEMARIO(cpc_input_data_id);
            cpc_temario.remove(temario_item_id);
        });
}

function cpc_temario_modal(title, content, func_yes){
    console.log("ON CPC_TEMARIO_MODAL");

    var modal_id = 'cpc_temario_modal_'+Date.now();
    var modal_html = '<div class="modal fade" id="'+modal_id+'" tabindex="-1" role="dialog" aria-labelledby="'+modal_id+'Label" aria-hidden="true">'+
                        '<div class="modal-dialog" role="document">'+
                            '<div class="modal-content">'+
                                '<div class="modal-header">'+
                                    '<h5 class="modal-title" id="'+modal_id+'Label">'+title+'</h5>'+
                                    '<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">'+
                                        '<span aria-hidden="true">&times;</span>'+
                                    '</button>'+
                                '</div>'+
                                '<div class="modal-body">'+
                                    content+
                                '</div>'+
                                '<div class="modal-footer">'+
                                    '<button id="'+modal_id+'_btn" type="button" class="btn btn-primary" data-bs-dismiss="modal" >Aceptar</button>'+
                                    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  data-bs-dismiss="modal" ">Cancelar</button>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
    jQuery('body').append(modal_html);
    jQuery('#'+modal_id+"_btn").on('click', function() {
        func_yes();
    });

    var options = {};
    var delete_modal = new bootstrap.Modal(document.getElementById(modal_id), options);
    delete_modal.show();
}

/************************************************************************************************
 * 
 * 
 * CPC INFORMACION
 * 
 * 
 * 
 */

function cpc_informacion_field_select_is_default(select_id, container_id, container_default_id)
{
    console.log("ON CPC_INFORMACION_FIELD_SELECT_IS_DEFAULT");
    var is_default = jQuery('#'+select_id).val();

    if(is_default == 'true'){
        jQuery('#'+container_default_id).show();
        jQuery('#'+container_id).hide();
    }else{
        jQuery('#'+container_default_id).hide();
        jQuery('#'+container_id).show();
    }
}











