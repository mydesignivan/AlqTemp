/* 
 * Clase Banner
 *
 */

var Banner = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(mode){
        mode_edit = mode;

        f = $('#form1')[0];

        $.validator.setting('#form1 .validate', {
            effect_show     : 'slidefade',
            validateOne     : true,
            addClass        : 'float-left'
        });

        $("input[name='txtName'], textarea[name='txtCode']").validator({
            v_required  : true
        });
    };

    this.save = function(){
        if( working ) return false;

        ajaxloader.show('Validando Formulario.');

        $.validator.validate('#form1 .validate', function(error){
            if( !error ){

                $.ajax({
                    type : 'post',
                    url  : baseURI+'paneladmin/banner/ajax_check/',
                    data : {
                        name : f.txtName.value,
                        id : f.banner_id.value
                    },
                    success : function(data){
                        if( data=="exists" ){
                            show_error(f.txtName, 'El nombre del banner ingresado ya existe.');

                        }else if( data=="notexists" ){
                            ajaxloader.show('Enviando Formulario.');
                            f.action = mode_edit ? baseURI+"paneladmin/banner/edit" : baseURI+"paneladmin/banner/create";
                            f.submit();

                        }else{
                            alert("ERROR: \n"+data);
                        }
                        if( data!="notexists" ) ajaxloader.hidden();
                    },
                    error   : function(result){
                        alert("ERROR: \n"+result.responseText);
                    }
                });
            }else ajaxloader.hidden();
        });
        return false;
    };



    /* PRIVATE PROPERTIES
     **************************************************************************/
    var working=false;
    var f=false;
    var mode_edit = false;

    /* PRIVATE METHODS
     **************************************************************************/
    var ajaxloader = {
        show : function(msg){
            working=true;

            var html = '<div class="text-center">';
                html+= msg+'<br />';
                html+= '<img src="images/ajax-loader5.gif" alt="" />';
                html+= '</div>';

            Popup.initializer({
                selContainer : '#sm-popup1',
                selContent   : '.sm-popup-middle',
                actionClose  : false
            });
            Popup.load_html(html);
        },
        hidden : function(){
            $.modal.close();
            working=false;
        }
    }

})();
