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


        var img = $('<p align="center"><img src="images/ajax-loader6.gif" alt="Cargando..." width="100" height="100" /></p>');
        var btnClose = $('<p align="center"><button type="button" class="button-small simplemodal-close">Cerrar</button></p>').hide();

        var iframe = $('<iframe></iframe>').attr('src', baseURI+'paneladmin/banner/ajax_popup_banner/'+banner_id);
        iframe.hide();
        iframe.load(function(){
            img.hide();
            $(this).show();
            btnClose.show();
            
            var content = this.contentDocument || this.contentWindow.document;
            var div = $(content.getElementById('banner_preview'));
            var w = div.width()+20;
            var h = div.height()+20;

            $(this).attr({
                'width'  : w,
                'height' : h
            });
            $('#sm-popup2, #simplemodal-container').css({
                width  : w+"px",
                height : (h+35)+"px"
            });

            Popup.center();
            working=false;
        });
        
        Popup.initializer({
            selContainer : '#sm-popup2',
            selContent   : '.sm-popup-middle .sm-popup-b2',
            effectOpen   : 'fade'
        });
        Popup.load_html(img,iframe,btnClose);

        return false;
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var working=false;
    var This=this;

    /* PRIVATE METHODS
     **************************************************************************/
    

})();
