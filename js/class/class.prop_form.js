/* 
 * Clase Prop
 *
 * Su funcion:
 *  - Crear, Modificar o Eliminar propiedades
 *  - Destaca prop o elimina prop destacadas.
 * 
 */

var Prop = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(res){
       mode_edit = res.mode;
       cuentaplus_active = res.cuentaplus;

       f = $('#formProp')[0];

       var thumbs = $('a.jq-thumb');
       if( thumbs.length>0 ){
           if( mode_edit ) thumbs.show();
           $('input.jq-uploadinput').bind('keypress', function(e){e.preventDefault();});
       }

       // Configura el validador
        $.validator.setting('#formProp .validate', {
            effect_show     : 'slidefade',
            validateOne     : true
        });
        $("#txtAddress, #txtDesc, #cboCategory, #cboCountry, #cboStates, #txtCity").validator({
            v_required  : true
        });

       // Configura el contador de caracteres
       var txtDesc = $('#txtDesc');
        txtDesc.data('char-count', 1000);
        txtDesc.keypress(function(e){
            var len = this.value.length;
            var char_count = $(this).data('char-count');

            if( e.which!=8 && e.which!=0 && len>(char_count-1) ) e.preventDefault();
            else return true;
        });
        txtDesc.keyup(function(e){
            $('#jq-charcounter b').text($(this).data('char-count')-this.value.length);
        });
        var count_char = !mode_edit ? txtDesc.data('char-count') : txtDesc.data('char-count')-txtDesc.val().length;
        $('#jq-charcounter b').text(count_char);
    
        // Inicializa otros objetos
        $('a.jq-thumb').fancybox();
        popup.initializer();

        if( res.cuentaplus ) {
            res.cuentaplus.draggable = true;

            if( mode_edit ) PGmap.initializer(res.cuentaplus);
            else PGmap.initializer();
        }
   };

    this.save = function(){
        if( working ) return false;

        //ajaxloader.show('Validando Formulario.');

        $.validator.validate('#formProp .validate', function(error){

            alert(error);

            //validUrlMovie();

            return;
            if( !error && validServices() && validImages() && validUrlMovie() ){

                var propid = $(f.prop_id).val();

                $.ajax({
                    type : 'post',
                    url  : baseURI+'paneluser/propiedades/ajax_check/',
                    data : {
                        address : f.txtAddress.value,
                        propid  : propid
                    },
                    success : function(data){
                        if( data=="exists" ){
                            show_error(f.txtAddress, 'La direcci&oacute;n ingresada ya existe.')
                            
                        }else if( data=="notexists" ){
                            ajaxloader.show('Enviando Formulario.');

                            var extra_post = {};

                            if( !mode_edit ){
                                extra_post.images_new = $('input.jq-uploadinput:not(empty)').toArrayValue();
                            }else{
                               //Busca Imagenes Nuevas
                               $('a.jq-thumbnew:visible').each(function(){
                                   var val = $(this).parent().find('input.jq-uploadinput').val();
                                   if( val!="" ) arr_images_new.push(val);
                               });

                               extra_post.images_new = arr_images_new;
                               extra_post.images_delete = arr_images_delete;
                               extra_post.images_modified_id = arr_images_modified.id;
                               extra_post.images_modified_name = arr_images_modified.name;
                            }

                            extra_post.services = $("#listServices").find("li input:checked").toArrayValue();
                            if( cuentaplus_active ){
                                PGmap.updateOptions();
                                extra_post.gmap_coorLat = PGmap.options.coorLat;
                                extra_post.gmap_coorLng = PGmap.options.coorLng;
                                extra_post.gmap_address = PGmap.options.address;
                                extra_post.gmap_zoom = PGmap.options.zoom;
                                extra_post.gmap_mapType = PGmap.options.mapType;

                                if( f.optMovie[0].checked ){
                                    var url = $(f.txtUrlMovie.value).find('param:first').attr('value');
                                    url = url.replace('http://www.youtube.com/', 'http://www.youtube-nocookie.com/');
                                    if( url.indexOf('&border=')>-1 ) url = url.substr(0, url.length-10)+"0";
                                    else url = url.substr(0, url.length-1)+"0";
                                    f.txtUrlMovie.value = url;
                                }
                            }

                            f.extra_post.value = JSON.encode(extra_post);
                            f.action = (propid=="") ? baseURI+"paneluser/propiedades/create" : baseURI+"paneluser/propiedades/edit/"+propid;
                            //f.submit();

                        }else alert("ERROR:\n"+data);

                        if( data!="notexists" ) ajaxloader.hidden();
                    },
                    error : function(result){
                        alert("ERROR:\n"+result.responseText);
                    }
                })

            }else ajaxloader.hidden();
        });
        return false;
    };

    this.append_row_file = function(el){
        if( working ) return false;
        working=true;
        
        var total_img = $('input.jq-uploadinput:not(empty)').length;

        $.get(baseURI+'paneluser/propiedades/ajax_check_total_images/'+total_img, function(data){
           if( data=="limitexceeded" ){
               alert('Ha superado el limite para cargar imagenes.');
           }else if( data=="accesdenied" ){
               alert('Estimado usuario, le informamos que el servicio gratuito que usted dispone, le permite cargar un maximo de tres imágenes.\nEn caso que desee cargar mas imágenes, debera obtener una "Cuenta Plus"');
           }else if( data=="ok" ){
                var divRow = $('<div class="clear span-16"></div>');
                var divCol = $('<div class="column-photo"></div>');
                var button = $('<div class="button-examin">Examinar</div>');
                var input  = $('<input type="text" name="" class="input-form float-left jq-uploadinput" value="" />');
                    input.bind('keypress', function(e){e.preventDefault();});

                divCol.append('<div class="ajaxloader2"><img src="images/ajax-loader.gif" alt="" />&nbsp;&nbsp;Subiendo Im&aacute;gen...</div>')
                      .append('<a href="#" class="append-right-small2 float-left hide jq-thumb jq-thumbnew" rel="group"><img src="" alt="" width="69" height="60" /></a>')
                      .append(input)
                      .append(button)
                      .append('<button type="button" class="button-small float-left" onclick="Prop.remove_row_file(this);">Eliminar</button>');

                divRow.append(divCol);

                $(el).parent().parent().before(divRow);
                AjaxUpload.append_input(button);
           }else{
               alert('ERROR\n'+data);
           }
           working=false;
        });

        return false;
    };

    this.remove_row_file = function(el, image_id){
        var filename = $(el).parent().find('input.jq-uploadinput').val();

        if( filename!="" ){
            if( confirm('¿Está seguro que desea quitar la imagen "'+filename+'"') ){
                $(el).parent().parent().remove();

                if( typeof image_id!="undefined" ) {
                    if( $.inArray(image_id, arr_images_delete)==-1 ){
                        arr_images_delete.push(image_id);
                    }

                    var key = $.inArray(image_id, arr_images_modified.id);
                    if( key!=-1 ){
                        arr_images_modified.id.unset_array(key);
                        arr_images_modified.name.unset_array(key);
                    }
                }
                $('a.jq-thumb').fancybox();
            }
            
        }else{
            $(el).parent().parent().remove();
        }
    };

    this.add_image_modified = function(id, name){
        if( $.inArray(id, arr_images_modified.id)==-1 ){
            arr_images_modified.id.push(id);
            arr_images_modified.name.push(name);
            if( $.inArray(id, arr_images_delete)==-1 ) arr_images_delete.push(id);
        }
    };

    this.show_states = function(el){
        el.disabled = true;
        $.get(baseURI+'paneluser/propiedades/ajax_show_states/'+el.value,'', function(data){
            $('#cboStates').empty()
                           .append(data);

            el.disabled = false;
        });
    };

    this.show_gmap = function(){
        if( $('#divGmap').css('visibility')=='hidden' ){
            $('#divGmap, #map').show2();
            $('html, body').animate({scrollTop : $(window).scrollTop()+260}, 'slow');
        }
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var mode_edit = false;
    var cuentaplus_active = false;
    var working = false;
    var arr_images_modified = {
        id : Array(),
        name : Array()
    };
    var arr_images_new = new Array();
    var arr_images_delete = new Array();
    var f=false;

    /* PRIVATE METHODS
     **************************************************************************/
    var validServices = function(){
        var msgbox = $('#msgbox_services').empty();

        if( $("#listServices").find("li input:checked").length == 0 ){
            show_error(msgbox, "Seleccione al menos un servicio.", msgbox);
            return false;
        }else $.validator.hide(msgbox);
        return true;
    };

    var validImages = function(){
        var msgbox = $('#msgbox_images').empty();

        if( $('a.jq-thumb:visible').length==0 ){
            show_error(msgbox, 'Debe ingresar al menos una im&aacute;gen.', msgbox);
            return false;
        }else $.validator.hide(msgbox);
        return true;
    };

    var validUrlMovie = function(){
        if( f.optMovie[1].checked || (!f.optMovie[0].checked && !f.optMovie[0].checked) ) return true;
        var el = f.txtUrlMovie;
        var msgbox = $('#msgbox_urlmovie').empty();

        if( el.value.length==0 ){
            show_error(msgbox, 'Debe ingresar el c&oacute;digo del video aqu&iacute;', msgbox);
            el.focus();
            return false;
        }
        var obj = $(el.value).find('param:first');
        if( obj.length==0 ){
            show_error(msgbox, 'El c&oacute;digo insertado no es v&aacute;lido.', "#msgbox_urlmovie");
            el.focus();
            return false;
        }
        if( obj.attr('value').indexOf('www.youtube')==-1 ){
            show_error(msgbox, 'La fuente del video debe ser extraido de <a href="http://www.youtube.com" target="_blank" class="link1">www.youtube.com</a>', msgbox);
            el.focus();
            return false;
        }

        $.validator.hide(msgbox);
        return true;
    };

    var ajaxloader = {
        show : function(msg){
            working=true;

            var html = '<div class="text-center">';
                html+= msg+'<br />';
                html+= '<img src="images/ajax-loader5.gif" alt="" />';
                html+= '</div>';

            popup.load({html : html}, {
                reload  : true,
                bloqEsc : true,
                effectClose : null
            });
        },
        hidden : function(){
            popup.close();
            working=false;
        }
    }

})();

var AjaxUpload = new ClassAjaxUpload({
    selector : 'div.button-examin',
    action   : baseURI+'ajax_upload',
    onSubmit : function(input, ext){
        if( !(ext && /^(jpg|png|jpeg|gif)$/.test(ext)) ){
            alert('Error: Solo se permiten imagenes');
            return false;
        } else {
            var divCol = $(input).parent().parent();
            var filename = input.value;
            if( $.browser.msie || $.browser.opera || $.browser.safari ){
                filename = input.value.split('\\');
                filename = filename[filename.length-1];
            }

            divCol.find('div.button-examin, input.input-form, a.jq-thumb, button').hide();
            divCol.find('div.ajaxloader2').show();
            divCol.find('input.input-form').val(filename);
        }
        return true;
    },
    onComplete : function(response, input){
        var divCol = $(input).parent().parent();

        try{
            eval('var filename = '+response);
        }catch(e){
            divCol.find('input.input-form').val('');
            alert("ERROR:\n"+response);
            return false;
        }

        divCol.find('div.ajaxloader2').hide();
        divCol.find('div.button-examin, input.input-form, button').show();
        
        var a = divCol.find('a.jq-thumb');
        var img = a.find(':first');
        img.attr('src', filename.filename_thumb);
        a.attr('href', filename.filename_full);
        a.show();
        if( $(input).parent()[0].id ){
            Prop.add_image_modified(parseInt($(input).parent()[0].id.substr(1)), divCol.find('input.input-form').val());
        }
        a.fancybox();
    }
});
$(document).ready(function(){AjaxUpload.initializer();});