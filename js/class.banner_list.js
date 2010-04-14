/* 
 * Clase Banner
 *
 */

var Banner = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        This.events.change_search($('#cboSearchBy').val(), true);
    };

    this.action={
        del : function(){
            var lstProp = $("#tblList tbody input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar un item.");
                return false;
            }

            var data = get_data(lstProp);

            if( confirm("¿Está seguro de confirmar el pago para el/los item(s) seleccionado(s)?\n\n"+data.names.join(", ")) ){
                location.href = baseURI+'paneladmin/pedidos/confirm/'+data.id.join("/");
            }
            return false;
        },
        edit : function(){
            var lstProp = $("#tblList tbody input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar un item.");
                return false;
            }

            var data = get_data(lstProp);

            if( confirm("¿Está seguro de confirmar el pago para el/los item(s) seleccionado(s)?\n\n"+data.names.join(", ")) ){
                location.href = baseURI+'paneladmin/pedidos/confirm/'+data.id.join("/");
            }
            return false;
        }
    };

    this.events={
        change_search : function(opt, clear){
            if( !clear ) $('#txtSearch').val('');

            $('#txtSearch').show();
            $('#cboPosition, #cboVisible').hide();
            
            if( opt=="position" ){
                $('#txtSearch, #cboVisible').hide();
                $('#cboPosition').show();
            }else if( opt=="visible" ){
                $('#cboPosition, #txtSearch').hide();
                $('#cboVisible').show();
            }
            $('#txtSearch').focus();
        }
    };

    this.Search = function(){
        if( $('#cboSearchBy').val()=="position" ) $('#txtSearch').val($('#cboPosition').val());
        else if( $('#cboSearchBy').val()=="visible" ) $('#txtSearch').val($('#cboVisible').val());
        if( $('#txtSearch').val()!='' ){
            location.href = baseURI+'paneladmin/banner/search/'+$('#cboSearchBy').val()+"/"+$('#txtSearch').val()+"/page";
        }
    };

    this.change_visible = function(tagA, user_id){
        if( working ) return false;
        working=true;

        $(tagA).hide();
        $(tagA).parent().find('img').show();

        var statu;

        if( tagA.innerHTML=="Activo" ) statu=0;
        else if( tagA.innerHTML=="Inactivo" ) statu=1;

        $.post(baseURI+'paneladmin/usuarios/ajax_change_statu/', {statu : statu, user_id : user_id}, function(data){
            if( data=="ok" ){
                if( statu==0 ) tagA.innerHTML = "Inactivo";
                else if ( statu==1 ) tagA.innerHTML = "Activo";
                $(tagA).parent().find('img').hide();
                $(tagA).show();
            }else alert('ERROR\n'+data);
            working = false;
        });

        return false;
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var working=false;
    var This=this;

    /* PRIVATE METHODS
     **************************************************************************/
    var get_data = function(arr){
        var names = [], id = [];

        arr.each(function(i){
            id.push(this.value);
            names.push($(this).parent().parent().find('.link-title').text());
        });

        return {
            id    : id,
            names : names
        }
    };

})();
