class CPC_PONENTES{
    temario_input_id;
    temario;

    constructor(temario_input_id){
        this.temario_input_id = temario_input_id;
    }

    get_values(){
        var temario_c = jQuery(this.temario_input_id).val();

        if(temario_c == ''){
            this.temario = new Array();
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

        console.log(JSON.parse(temario_c));
        console.log(this.temario);  
        return this.temario;
    }

    update(values){
        jQuery(this.temario_input_id).val( JSON.stringify(values) );
    }

    remove(remove_key){
        var values = this.get_values();
        
        var index = values.indexOf(remove_key);
        if(index > -1){
            values.splice(index, 1);
        }

        this.update(values);
    }
    add(value){
        var values = this.get_values();

        if(values.includes(value)) return;

        values.push(value);
    
        var string_values = JSON.stringify(values);

        jQuery(this.temario_input_id).val( string_values );
    }

    reset(){
        this.temario = [];
        jQuery(this.temario_input_id).val( '{}' );
    }
}


const cpc_field_ponentes_data = '#cpc_capacitacion_field_ponentes';
const cpc_ponentes = new CPC_PONENTES(cpc_field_ponentes_data);


jQuery(document).ready(function(){
    jQuery(".cpc_cpt_btn_add_ponente").click(function(){
        ponente_id = jQuery(this).attr("data-ponente-id");

        jQuery(this).html("Añadido");
        jQuery(this).attr("disabled", "disabled");

        jQuery("#cpc_ponente_btn_delete_"+ponente_id).show();
        jQuery("#cpc_ponente_btn_delete_"+ponente_id).click(function(){
            cpc_ponentes.remove(ponente_id);

            jQuery(this).hide();
            jQuery("#cpc_ponente_btn_add_"+ponente_id).html("Añadir");
            jQuery("#cpc_ponente_btn_add_"+ponente_id).removeAttr("disabled");
        });

        cpc_ponentes.add(ponente_id);
    });
});
