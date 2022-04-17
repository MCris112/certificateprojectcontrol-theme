class CPC_FECHAS{
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
        jQuery("#cpc_field_multidays_container_items").empty();
        cpc_fechas_show_values(values); 
    }

    remove(remove_key){
        var values = this.get_values();
        var new_values = new Array();

        jQuery.each(values, function(key, val){
            console.log("key: " + key + " value: " + val + " remove: " + remove_key);
            if(key == remove_key){
                jQuery('#cpc_field_'+key+"_item").remove();
            }else{
                new_values.push(val);
            }
        });

        this.update(new_values);
    }
    add(value){
        var values = this.get_values();

        values.push(value);
    
        var string_values = JSON.stringify(values);

        document.getElementById("cpc_field_fechas_array").value = string_values;
        //jQuery(this.temario_input_id).val( string_values );
    }

    reset(){
        this.temario = [];
        jQuery(this.temario_input_id).val( '[]' );
    }
}

const cpc_field_fechas_data = '#cpc_field_fechas_array';
const cpc_fechas = new CPC_FECHAS(cpc_field_fechas_data);

jQuery(document).ready(function() {
    //Activate datepicker adn timepicker
    cpc_field_datepicker_activate_func();
    cpc_activate_modalidad_days();

    
    cpc_fechas_show_values(cpc_fechas.get_values());

    jQuery('#cpc_capacitacion_field_modalidad').on('change', function() {
        cpc_field_datepicker_activate_func();
    });
});




function cpc_field_datepicker_activate_func(){
    if(jQuery('#cpc_capacitacion_field_modalidad').val() == 'sincronico'){
        jQuery("#cpc_field_datepicker_container").show();
        jQuery(".cpc_field_datepicker").datepicker({
            dateFormat: "dd-mm-yy",
        });

        jQuery(".cpc_field_timepicker").timepicker({
            timeFormat: 'h:mm p',
            interval: 30,
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    }else{
        jQuery("#cpc_field_datepicker_container").hide();
    }
    
}


function cpc_fechas_show_values(values) {
    var temario = values;

    jQuery.each(temario, function(key, val){
 
         cpc_fechas_show_item(val, key);
     });
}

function cpc_fechas_show_item(val, key){

    $item_html = `<div class="input-group mb-3" id="#cpc_field_`+key+`_item">
                        <button type="button"class="btn btn-danger" onclick="cpc_fechas_remove_item(`+key+`);"><i class="fa fa-trash-o fa-lg"></i></button>   
                        <input type="text" class="form-control cpc_field_datepicker" name="cpc_capacitacion_field_modalidad_fechas[`+key+`]" value="`+val+`" autocomplete="off">
                </div>`;

    jQuery('#cpc_field_multidays_container_items').append($item_html);
}

function cpc_fechas_add_item(val){
    cpc_fechas.add(val);
    values = cpc_fechas.get_values();
    key = values.length;

    cpc_fechas_show_item(val, key);
}

function cpc_fechas_remove_item(key){
    cpc_fechas.remove(key);
}

var dates = cpc_fechas.get_values();
console.log(Array.isArray(dates));

function addDate(date) {
    if ( dates.includes(date) ) return;

    dates.push(date);
    cpc_fechas_add_item(date);
}

function removeDate(index) {
    dates.splice(index, 1);
}

// Adds a date if we don't have it yet, else remove it
function addOrRemoveDate(date) {
    var index = jQuery.inArray(date, dates);
    if (index >= 0) 
        removeDate(index);
    else 
        addDate(date);
}

// Takes a 1-digit number and inserts a zero before it
function padNumber(number) {
    var ret = new String(number);
    if (ret.length == 1) 
        ret = "0" + ret;
    return ret;
}

function cpc_activate_modalidad_days(){
    jQuery("#datepicker_fechas").datepicker({
        dateFormat: "dd-mm-yy",
    onSelect: function (dateText, inst) {
        addOrRemoveDate(dateText);
    },
    beforeShowDay: function (date) {
        var year = date.getFullYear();
        // months and days are inserted into the array in the form, e.g "01/01/2009", but here the format is "1/1/2009"
        var month = padNumber(date.getMonth() + 1);
        var day = padNumber(date.getDate());
        // This depends on the datepicker's date format
        var dateString = month + "/" + day + "/" + year;

        var gotDate = jQuery.inArray(dateString, dates);
        if (gotDate >= 0) {
            // Enable date so it can be deselected. Set style to be highlighted
            return [true, "ui-state-highlight"];
        }
        // Dates not in the array are left enabled, but with no extra style
        return [true, ""];
    }
});
}