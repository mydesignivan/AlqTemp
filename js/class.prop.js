/* 
 * Clase 
 * 
 */

var Prop = new (function(){

    /*
     * CONSTRUCTOR
     */
    $(document).ready(function(){
       //document.formProp.cboCountry.selectedIndex=0;

    });


    /*
     * PUBLIC METHODS
     */
    this.save = function(){
        AjaxUpload.submit();
        return;
        if( working ) return;

        ValidatorProp.validate(function(error){
            if( !error && validServices() ){
                working=true;
                var propid="";
                if( document.formProp.prop_id.value!="" ) propid = "/"+document.formProp.prop_id.value;
                
                $('#ajaxloader').show();
                $.get(document.baseURI+'index.php/ajax_prop/valid/'+escape(document.formProp.txtAddress.value)+propid, function(data){
                    if( data=="exists" ){
                        if( $('#contmessage').is(':hidden') ){
                            $('#contmessage').html('La propiedad ingresada ya existe.');
                            $('#contmessage').slideToggle('slow');
                        }
                        $('#ajaxloader').hide();
                        working=false;
                    }else{
                        var servsel="";
                        checkServ.each(function(){
                            servsel+=this.value+",";
                        });
                        servsel = servsel.substr(0, servsel.length-1);

                        document.formProp.services.value = servsel;
                        document.formProp.action = (propid=="") ? document.baseURI+"index.php/prop/create" : document.baseURI+"index.php/prop/edit"+propid;
                        document.formProp.submit();
                    }
                });

            }else{
                alert('Se han encontrado errores.\nPor favor, revise el formulario.');
            }
        });
    };

    this.action={
        edit : function(){
            var lstProp = $("#tblProp .table_left input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar una propiedad para modificar.");
                return false;
            }
            if( lstProp.length>1 ){
                alert("Debe seleccionar una sola propiedad.");
                return false;
            }
            location.href = document.baseURI+'index.php/prop/form/'+lstProp.val();
            return false;
        },

        del : function(){
            var lstProp = $("#tblProp .table_left input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar una propiedad.");
                return false;
            }
            //var div = $("#tblProp .table_center");
            var namesProp="";
            var propid="";
            lstProp.each(function(i){
                propid+=this.value+",";
                namesProp+= $(this).parent().parent().find('.table_center').html()+", ";
            });

            propid = propid.substr(0, propid.length-1);
            namesProp = namesProp.substr(0, namesProp.length-2);

            if( confirm("¿Está seguro de eliminar la(s) propiedad(es) seleccionada(s)?\n\n"+namesProp) ){
                location.href = document.baseURI+'index.php/prop/delete/'+propid;
            }

            return false;
        }
    }

    this.append_row_file = function(el){
        var divRow = $('<div class="row"></div>');
        var divCol = $('<div class="col"></div>');
        var button = $('<div class="button2 float-left btnexamin">Examinar</div>');

        divCol.append('<div class="ajaxloader2"><img src="images/ajax-loader.gif" alt="" />&nbsp;&nbsp;Subiendo Im&aacute;gen...</div>')
              .append('<a href="#" class="previewthumb"><img src="" alt="" width="69" height="60" /></a>')
              .append('<input type="text" name="" class="input style_input float-left" value="" />')
              .append(button)
              .append('<a class="button2 float-left" onclick="Prop.remove_row_file(this); return false;">Eliminar</a>');
              
        divRow.append(divCol);

        $(el).parent().before(divRow);
        AjaxUpload.append_input(button);
    };

    this.remove_row_file = function(el){
        $(el).parent().parent().remove();
    };

    /*
     * PRIVATE PROPERTIES
     */
    var checkServ;
    var working=false;

    /*
     * PRIVATE METHODS
     */
    var validServices = function(){
        checkServ = $("#lstServices").find("li input:checked");
        if( checkServ.length == 0 ){
            ValidatorProp.message.hidden("#formProp .validate");
            ValidatorProp.message.show("#contServices", ['Seleccione al menos un servicio.']);
            return false;
        }
        return true;
    };



})();

var ValidatorProp = new Class_Validator({
    selectors : '#formProp .validate',
    messageClass : 'formError_Account',
    messagePos : 'up',
    validationOne : true
});

var AjaxUpload = new ClassAjaxUpload({
    selector : '.btnexamin',
    action   : document.baseURI+'index.php/ajax_upload',
    onSubmit : function(input, ext){
        if( !(ext && /^(jpg|png|jpeg|gif)$/.test(ext)) ){
            alert('Error: Solo se permiten imagenes');
            return false;
        } else {
            var divCol = $(input).parent().parent();
            divCol.find('div.btnexamin, input.style_input').hide();
            divCol.find('div.ajaxloader2').show();
            divCol.find('input.style_input').val(input.value);
        }
        return true;
    },
    onComplete : function(response, input){
        var divCol = $(input).parent().parent();

        divCol.find('div.ajaxloader2').hide();
        divCol.find('div.btnexamin, input.style_input').show();

        if( /^(filename:)/.test(response) ){
            var filename = response.substr(9);
            var a = divCol.find('a.previewthumb');
            var img = a.find(':first')
            img.attr('src', 'tmp/'+filename)
            a.show();
        }else{
            divCol.find('input.style_input').val('');
            alert(response);
        }

    }
});
