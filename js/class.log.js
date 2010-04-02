/* 
 * Clase Log
 *
 */

var Log = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.action={
        del : function(){
            var index = new Array();
                index = $('#tblList tbody input:checked').toArrayValue();
            if( index.length>0 ){
                location.href = baseURI+'paneladmin/log/delete/'+$('#cboDate').val()+'/'+index.join('/');
            }else{
                alert("Debe seleccionar al menos un item.");
            }
        },
        del_date : function(){
            var dname = $('#cboDate').val();
            if( confirm('¿Está seguro que desea eliminar la fecha "'+dname+'"?') ){
                location.href = baseURI+'paneladmin/log/delete_date/'+dname;
            }
        }
    }

})();
