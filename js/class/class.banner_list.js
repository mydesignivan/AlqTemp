/* 
 * Clase Banner
 *
 */

var Banner = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        This.events.change_search($('#cboSearchBy').val(), true);

        var index_start=0;

        $("#tblList").tableDnD({
            onDragStart : function(table, row){
                index_start=row.rowIndex;
            },
            onDrop : function(table, row){
                /*for( var n=index_start; n<=row.rowIndex; n++ ){
                    alert(table.rows[n].cells[1].innerHTML);
                }*/


                /*var row2 = $(row).prev()[0];
                if( row2==null ) row2 = $(row).next()[0];



                var id1 = $(row.cells[0]).find('input').val();
                var id2 = $(row2.cells[0]).find('input').val();

                $.post(baseURI+'paneladmin/banner/ajax_change_order', {id1:id1, id2:id2}, function(data){
                    if( data!='ok' ) alert('ERROR:\n'+data);
                });*/
            }
        });

        popup.initializer();
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

    this.open_popup = function(banner_id){
        if( working ) return false;
        working=true;
        
        $('#jquery-popup').css({
            display : 'block',
            visibility : 'hidden'
        });
        $('#ifrPreview').attr('src', baseURI+'paneladmin/banner/ajax_view_banner/'+banner_id)
                        .load(function(){
                            var content = this.contentDocument || this.contentWindow.document;
                            var div = $(content.getElementById('banner_preview'));
                            var w = div.width()+20;
                            var h = div.height()+20;

                            $(this).attr({
                                'width'  : w,
                                'height' : h
                            });
                            $('#jquery-popup').css({
                                display : 'none',
                                visibility : 'visible',
                                width  : w+"px",
                                height : (h+35)+"px"
                            });

                            popup.load({}, {
                                selector_content : '.jquery-popup-middle .jquery-popup-b2'
                            });
                            working=false;
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