/* 
 * Clase encargada del logeo
 * 
 */

var Login = new (function(){

    /*
     * METHODS PUBLIC
     */
    this.open_dialog = function(){
        $('#login-container .signin').hide();
        $('#login-container .container-form').show();
        $('#formLogin')[0].txtLoginUser.focus();
        opendialog=true;
    };
    this.close_dialog = function(){
        $('#login-container .signin').show();
        $('#login-container .container-form').hide();
        opendialog=false;
    };

    this.message_show = function(msg){
        slideUp=false;
        $('#message-login').html(msg)
                           .show()
                           .animate({top : 0}, 'slow')
                           .bind('mousemove', function(){
                               if( slideUp ) return false;
                               slideUp=true;
                               $(this).animate({top : '-=34'}, 'slow', function(){$(this).hide();});
                               return false;
                           });
        setTimeout(function(){
            $('#message-login').animate({top : '-=34'}, 'slow', function(){$(this).hide();});
        }, 6000);
    };

    /*
     * PROPERTIES PRIVATE
     */
    var mouse_over=false;
    var opendialog=false;
    var This=this;
    var slideUp=false;

    /*
     * CONSTRUCTOR
     */
    $(document).ready(function(){
        $(document.body).click(function(){
            if( !mouse_over && opendialog ){
                This.close_dialog();
            }
        });
        $('#login-container').hover(function(){mouse_over=true;}, function(){mouse_over=false;});
    });

})();
