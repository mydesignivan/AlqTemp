/* 
 * Clase Orders
 *
 */

var Orders = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        This.events.change_search($('#cboSearchBy').val(), true);
        popup.initializer();
    };

    this.action={
        Confirm : function(){
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
            $('#cboStatus').hide();
            
            if( opt=="date" ) {
                $('#txtSearch').attr('maxlength', 19)
                               .bind('keypress', This.events.dateformat);
            }else if( opt=="status" ){
                $('#txtSearch').hide();
                $('#cboStatus').show();
            }else{
                $('#txtSearch').unbind('keypress')
                               .removeAttr('maxlength');
            }
            $('#txtSearch').focus();
        },
        dateformat : function(e){
            if (e.which >= 48 && e.which <= 57 || e.which == 8) {
                var count = this.value.length;
                if( e.which!=8 ){
                    if( count==2 || count==5 ) this.value+="-";
                    if( count==10 ) this.value+=" ";
                    if( count==13 || count==16 ) this.value+=":";
                }else{
                    if( count==4 || count==7 || count==12 || count==15 || count==18) this.value = this.value.substr(0, this.value.length-1);
                }

                return true;
            }else {
                e.preventDefault();
            }
        }
    };

    this.Search = function(){
        if( $('#cboSearchBy').val()=="status" ) $('#txtSearch').val($('#cboStatus').val());
        if( $('#txtSearch').val()!='' ){
            location.href = baseURI+'paneladmin/pedidos/search/'+$('#cboSearchBy').val()+"/"+$('#txtSearch').val()+"/page";
        }
    };

    this.change_status = function(tagA, user_id){
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

    this.open_popup = function(user_id){
        popup.load({
            ajaxUrl  : baseURI+'paneladmin/pedidos/ajax_view_details/',
            ajaxData : 'user_id='+user_id
        }, {
            selector_content : '.jquery-popup-middle .jquery-popup-b2',
            effectOpen       : 'autoresize',
            effectClose      : 'autoresize',
            effectOptions    : {
                width   :   '385px',
                height  :   '230px'
            },
            contentDefault   : '<div class="text-center"><img src="images/ajax-loader4.gif" alt="" /></div>'
        });

    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var working=false;
    var This=this;

    /* PRIVATE METHODS
     **************************************************************************/

})();
