jQuery(document).ready(function() {

    var mediaUploaderPC_bg, mediaUploaderPC_txt, mediaUploaderPHONE_bg, mediaUploaderPHONE_txt;

    jQuery("#cpc_slider_phone_input_btn_bg").on("click", function(e){
        e.preventDefault();

        if(mediaUploaderPC_bg){
            mediaUploaderPC_bg.open();
            return;
        }

        mediaUploaderPC_bg = wp.media.frames.file_frame = wp.media({
            title: "Seleccionar Imagen de fondo para el Slider - Vista Celular",
            button: {
                text: "Seleccionar Imagen de fondo"
            },
            multiple: false
        });

        mediaUploaderPC_bg.on('select', function(){
            attachment = mediaUploaderPC_bg.state().get('selection').first().toJSON();

            jQuery("#cpc_slider_phone_input_img_bg").val(attachment.url);
            jQuery("#cpc_slider_bg_img_phone").attr("src", attachment.url);

        });

        mediaUploaderPC_bg.open();
    });

    jQuery("#cpc_slider_phone_input_btn_txt").on("click", function(e){
        e.preventDefault();

        if(mediaUploaderPC_txt){
            mediaUploaderPC_txt.open();
            return;
        }

        mediaUploaderPC_txt = wp.media.frames.file_frame = wp.media({
            title: "Seleccionar Imagen texto para el slider - Vista Celular",
            button: {
                text: "Seleccionar Imagen de fondo"
            },
            multiple: false
        });

        mediaUploaderPC_txt.on('select', function(){
            attachment = mediaUploaderPC_txt.state().get('selection').first().toJSON();

            jQuery("#cpc_slider_phone_input_img_txt").val(attachment.url);
            jQuery("#cpc_slider_txt_img_phone").attr("src", attachment.url);
        });

        mediaUploaderPC_txt.open();
    });

    jQuery("#cpc_slider_pc_input_btn_bg").on("click", function(e){
        e.preventDefault();

        if(mediaUploaderPHONE_bg){
            mediaUploaderPHONE_bg.open();
            return;
        }

        mediaUploaderPHONE_bg = wp.media.frames.file_frame = wp.media({
            title: "Seleccionar Imagen de fondo para el Slider - Vista PC",
            button: {
                text: "Seleccionar Imagen de fondo"
            },
            multiple: false
        });

        mediaUploaderPHONE_bg.on('select', function(){
            attachment = mediaUploaderPHONE_bg.state().get('selection').first().toJSON();

            jQuery("#cpc_slider_pc_input_img_bg").val(attachment.url);
            jQuery("#cpc_slider_txt_img_pc").attr("src", attachment.url);
        });

        mediaUploaderPHONE_bg.open();
    });

    jQuery("#cpc_slider_pc_input_btn_txt").on("click", function(e){
        e.preventDefault();

        if(mediaUploaderPHONE_txt){
            mediaUploaderPHONE_txt.open();
            return;
        }

        mediaUploaderPHONE_txt = wp.media.frames.file_frame = wp.media({
            title: "Seleccionar Imagen de texto - Vista PC",
            button: {
                text: "Seleccionar Imagen de fondo"
            },
            multiple: false
        });

        mediaUploaderPHONE_txt.on('select', function(){
            attachment = mediaUploaderPHONE_txt.state().get('selection').first().toJSON();

            jQuery("#cpc_slider_pc_input_img_txt").val( attachment.url );
            jQuery("#cpc_slider_bg_img_pc").attr("src", attachment.url);
        });

        mediaUploaderPHONE_txt.open();
    });
});