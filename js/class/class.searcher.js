
var Searcher = new (function(){
    /* PUBLIC METHODS
     **************************************************************************/
    this.initializer = function(){
        comboCountry = $('#formSearch select[name=country]');
        comboState = $('#formSearch select[name=state]');
        comboCity = $('#formSearch select[name=city]');
        comboCategory = $('#formSearch select[name=category]');
    };

    this.show_combo = function(el){
        if( el.value==0 ) return false;

        if( 
            (el.name=='category' && comboState[0].value!=0 && comboCity[0].value!=0) ||
            (el.name=='city' && comboState[0].value!=0 && comboCategory[0].value!=0)
        ) return false;

        disabled_combo(true);

        /*$.get(baseURI+'index/ajax_show_combo/'+el.value+'/'+el.name, '', function(data){
            alert(data);
        });
        return;*/

        var notsearch='';
        if( (el.name=='city' || el.name=='category') && comboState[0].value!=0 ) notsearch = 'state';
        else if( el.name=='category' && comboCity[0].value!=0 ) notsearch = 'city';
        //else if( (el.name=='city') && comboCategory[0].value!=0 ) notsearch = 'category';

        //alert(notsearch);

        $.getJSON(baseURI+'index/ajax_show_combo/'+el.value+'/'+el.name+'/'+notsearch, '', function(data){
            
            // Muestra las Provincias
            if( el.name=='country' || ((el.name=='city' || el.name=='category') && comboState[0].value==0)  ){
                comboState.empty();
                $(data.state).each(function(i){
                    if( i==0 ) comboState.append('<option value="0">'+ this +'</option>');
                    else comboState.append('<option value="'+this.state_id+'">'+this.name+'</option>');
                });
            }
            // Muestra las Ciudades
            if( (el.name=='country' || el.name=='state') || (el.name=='category' && comboCity[0].value==0) ){

                if( el.name=='state' ) $('#formSearch select[name=country] option[value='+data.country_id+']')[0].selected=true;

                comboCity.empty();
                $(data.city).each(function(i){
                    if( i==0 ) comboCity.append('<option value="0">'+ this +'</option>');
                    else comboCity.append('<option value="'+this.city+'">'+this.city+'</option>');
                });
            }
            // Muestra las Categorias
            if( el.name!='category' ){
                comboCategory.empty();
                $(data.category).each(function(i){
                    if( i==0 ) comboCategory.append('<option value="0">'+ this +'</option>');
                    else comboCategory.append('<option value="'+this.category_id+'">'+this.name+'</option>');
                });
            }
            
            disabled_combo(false);
        });

        return false;
    };


    /* PRIVATE PROPERTIES
     **************************************************************************/
    var comboCountry;
    var comboState;
    var comboCity;
    var comboCategory;


    /* PRIVATE METHODS
     **************************************************************************/
    var disabled_combo = function(val){
        comboCountry[0].disabled = val;
        comboState[0].disabled = val;
        comboCity[0].disabled = val;
        comboCategory[0].disabled = val;
    }

})();
