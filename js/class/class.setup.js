var Setup = new (function(){

    /* PUBLIC METHODS
     **************************************************************************/
     this.initializer = function(){
        $('#tabs').tabs();

       // Configura el validador
        $.validator.setting('#form1 .validate', {
            effect_show     : 'fade',
            validateOne     : true
        });
        $("#gral_time_propdisting, #gral_time_cp, #gral_costo_disting, #gral_costo_cp").validator({
            v_required  : true,
            addClass    : 'validator-setup'
        });
        $("#gral_count_freeimages, #gral_count_imagescp").validator({
            v_required  : true,
            addClass    : 'validator-setup2'
        });

        formatNumber.init('#gral_time_propdisting, #gral_time_cp, #gral_count_freeimages, #gral_count_imagescp', {integerNumber:true});
        formatNumber.init('#gral_costo_disting, #gral_costo_cp', {integerNumber:false, decimalDigit:2, autoFormat:true});
     };

     this.save = function(){
         if( confirm("¿Está usted seguro de guardar los cambios?") ){
            $.validator.validate('#formProp .validate', function(error){
                if( !error ){
                    $('#form1').submit();
                }
            });
         }
         return true;
     };


    /* PRIVATE PROPERTIES
     **************************************************************************/

})();
