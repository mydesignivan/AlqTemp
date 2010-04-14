/* 
 * Clase Banner
 *
 */

var Banner = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        This.events.change_search($('#cboSearchBy').val(), true);

        $("#tblList").tableDnD({
            onDragStart : function(table, row){
                $(this).data('tableDnD-data', parseInt(row.id.substr(2)));
            },
            onDrop : function(table, row){
                var index = $(this).data('tableDnD-data');

                var id1 = $(row.cells[0]).find('input').val();
                var id2 = $(table.rows[index]).find('td:first').find('input').val();

                document.title = id1 + " / " + id2;

                /*$.post(baseURI+'paneladmin/banner/ajax_change_order', {id1:id1, id2:id2}, function(data){
                    
                });*/
            }
        });
    };

    this.action={
        edit : function(){
            var lstProp = $("#tblList tbody input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar un item para modificar.");
                return true;
            }
            if( lstProp.length>1 ){
                alert("Debe seleccionar un solo item.");
                return false;
            }
            location.href = baseURI+'paneladmin/banner/form/'+lstProp.val();
            return false;
        },

        del : function(){
            var lstProp = $("#tblList tbody input:checked");
            if( lstProp.length==0 ){
                alert("Debe seleccionar al menos un item.");
                return false;
            }

            var data = get_data(lstProp);

            if( confirm("¿Está seguro de eliminar el/los item(s) seleccionado(s)?\n\n"+data.names.join(", ")) ){
                location.href = baseURI+'paneladmin/banner/delete/'+data.id.join("/");
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

    this.change_visible = function(tagA, id){
        if( working ) return false;
        working=true;

        $(tagA).hide();
        $(tagA).parent().find('img').show();

        var statu;

        if( tagA.innerHTML=="Visible" ) statu=0;
        else if( tagA.innerHTML=="Oculto" ) statu=1;

        $.post(baseURI+'paneladmin/banner/ajax_change_visible/', {statu : statu, id : id}, function(data){
            if( data=="ok" ){
                if( statu==0 ) tagA.innerHTML = "Oculto";
                else if ( statu==1 ) tagA.innerHTML = "Visible";
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
