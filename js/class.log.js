/* 
 * Clase Log
 *
 * Llamada por las vistas: paneladmin_log_view
 *
 */

var Log = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.action={
        del : function(){
            var list = $('#tblList').find('input:checked');
            var index = new Array();
            list.each(function(){
                index.push(this.value);
            });
            location.href = baseURI+'paneladmin/log/delete/'+$('#cboDate').val()+'/'+index.join('/');
        },
        del_date : function(){
            var dname = $('#cboDate').val();
            if( confirm('¿Está seguro que desea eliminar la fecha "'+dname+'"?') ){
                location.href = baseURI+'paneladmin/log/delete_date/'+dname;
            }
        }
    }

})();
