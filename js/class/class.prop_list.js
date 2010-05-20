/* 
 * Clase Prop
 *
 * Esta clase es llamada en el listado de propiedades
 * 
 */

var Prop = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        This.events.change_search($('#cboSearchBy').val(), true);
    },

    this.action={
        edit : function(){
            var lstProp = $("#tblList tbody input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar una propiedad para modificar.");
                return true;
            }
            if( lstProp.length>1 ){
                alert("Debe seleccionar una sola propiedad.");
                return false;
            }
            location.href = baseURI+'paneluser/propiedades/form/'+lstProp.val();
            return false;
        },

        del : function(){
            var lstProp = $("#tblList tbody input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar una propiedad.");
                return false;
            }
            
            var data = get_data(lstProp);

            if( confirm("¿Está seguro de eliminar la(s) propiedad(es) seleccionada(s)?\n\n"+data.names.join(", ")) ){
                location.href = baseURI+panelName+'propiedades/delete/'+data.id.join("/");
            }
            return false;
        }
    };

    this.events={
        change_search : function(opt, clear){
            if( !clear ) $('#txtSearch').val('');
            $('#txtSearch').focus();

            if( opt=="date_added" || opt=="last_modified" ) {
                $('#txtSearch').attr('maxlength', 19)
                               .bind('keypress', This.events.dateformat);
            }else{
                $('#txtSearch').unbind('keypress')
                               .removeAttr('maxlength');
            }
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
        if( $('#txtSearch').val()!='' ){
            location.href = baseURI+'paneladmin/propiedades/search/'+$('#cboSearchBy').val()+"/"+$('#txtSearch').val()+"/page";
        }
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var This=this;

    /* PRIVATE METHODS
     **************************************************************************/
    
})();