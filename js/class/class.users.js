/* 
 * Clase Usuarios
 * Esta clase es utilizada en el listado de usuario del administrador
 *
 */

var Users = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        This.events.change_search($('#cboSearchBy').val(), true);
    };

    this.action={
        del : function(){
            var lstProp = $("#tblList tbody input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar un usuario.");
                return false;
            }

            var data = get_data(lstProp);

            if( confirm("¿Está seguro de eliminar el/los usuario(s) seleccionado(s)?\n\n"+data.names.join(", ")) ){
                location.href = baseURI+'paneladmin/usuarios/delete/'+data.id.join("/");
            }
            return false;
        }
    };

    this.events={
        change_search : function(opt, clear){
            if( !clear ) $('#txtSearch').val('');
            $('#txtSearch').focus();

            $('#txtSearch').show();
            $('#cboStatus, select.jq-date').hide();

            if( opt=="date_added" || opt=="last_modified" ) {
                $('select.jq-date').show();
                $('#txtSearch').hide();
                
            }else if( opt=="active" ){
                $('#txtSearch').hide();
                $('#cboStatus').show();            
            }
        }/*,
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
        }*/
    };

    this.Search = function(){
        var opt = $('#cboSearchBy').val();
        if( opt=="active" ) $('#txtSearch').val($('#cboStatus').val());
        else if( opt=="date_added" || opt=="last_modified" ){
            $('#txtSearch').val($('#cboDateDay').val()+"-"+$('#cboDateMonth').val()+"-"+$('#cboDateYear').val());
        }

        if( $('#txtSearch').val()!='' ){
            location.href = baseURI+'paneladmin/usuarios/search/'+$('#cboSearchBy').val()+"/"+$('#txtSearch').val()+"/page";
        }
    };

    this.change_status = function(tagA, user_id){
        if( working ) return false;
        var statu;

        if( tagA.innerHTML=="Activo" ) statu=0;
        else if( tagA.innerHTML=="Inactivo" ) statu=1;

        if( confirm("¿Está seguro de poner "+ ((statu==0) ? "Inactivo" : "Activo") +" al usuario?") ){
            $(tagA).hide();
            $(tagA).parent().find('img').show();
            working=true;
            $.post(baseURI+'paneladmin/usuarios/ajax_change_statu/', {statu : statu, user_id : user_id}, function(data){
                if( data=="ok" ){
                    if( statu==0 ) tagA.innerHTML = "Inactivo";
                    else if ( statu==1 ) tagA.innerHTML = "Activo";
                    $(tagA).parent().find('img').hide();
                    $(tagA).show();
                }else alert('ERROR\n'+data);
                working = false;
            });
        }

        return false;
    };

    this.open_popup = function(user_id){
        Popup.initializer({
            selContainer : '#sm-popup2',
            selContent   : '.sm-popup-middle .sm-popup-b2',
            width        : '385px',
            height       : '250px',
            effectOpen   : 'fade'
        });
        Popup.load_ajax(baseURI+'paneladmin/usuarios/ajax_popup_userdetail/', 'user_id='+user_id);
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var working=false;
    var This=this;

    /* PRIVATE METHODS
     **************************************************************************/

})();
