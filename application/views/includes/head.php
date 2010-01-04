<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />

<link href="<?=$_SERVER['REQUEST_URI'];?>images/favicon.ico" rel="stylesheet icon" type="image/ico" />
<link href="<?=$_SERVER['REQUEST_URI'];?>styles/style.css" rel="stylesheet" type="text/css" />

<!--[if IE]>
<link href="<?=$_SERVER['REQUEST_URI'];?>styles/styleIE.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--========== LIBRARIES ============-->
<script type="text/JavaScript" src="<?=$_SERVER['REQUEST_URI'];?>js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?=$_SERVER['REQUEST_URI'];?>js/helpers.js"></script>
<!--========== END LIBRARIES =======-->


<!--============ SCRIPT: SUPERFISH (Menus Desplegables) =================-->
<link rel="stylesheet" type="text/css" href="<?=$_SERVER['REQUEST_URI'];?>js/jquery.superfish/css/superfish.css" media="screen">
<script type="text/javascript" src="<?=$_SERVER['REQUEST_URI'];?>js/jquery.superfish/js/hoverIntent.js"></script>
<script type="text/javascript" src="<?=$_SERVER['REQUEST_URI'];?>js/jquery.superfish/js/superfish.js"></script>
<script type="text/javascript">
    jQuery(function(){
        jQuery('ul.sf-menu').superfish();
    });
</script>
<!--======= END SCRIPT =======-->

<!--============ SCRIPT: JQuery Validator =================-->
<link href="<?=$_SERVER['REQUEST_URI'];?>js/jquery.validator/css/jquery.validate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$_SERVER['REQUEST_URI'];?>js/jquery.validator/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?=$_SERVER['REQUEST_URI'];?>js/jquery.validator/js/jquery.validate.messages.js"></script>
<script type="text/javascript" src="<?=$_SERVER['REQUEST_URI'];?>js/jquery.validator/js/execute.js"></script>
<!--======= END SCRIPT =======-->



<!--========== CLASS ============-->
<script type="text/javascript" src="<?=$_SERVER['REQUEST_URI'];?>js/class.login.js"></script>

<!--======= END CLASS =======-->

<?php if( $_SERVER['REQUEST_METHOD']=="POST" && $_POST["action"]=="login" && !$logged_in ) {?>
    <script type="text/javascript">
    <!--
    $(document).ready(function(){
        ValidatorLogin.message.show('#btnLogin', ['El usuario y/o password son incorrectos.']);
    });
    -->
    </script>
<?php }?>


<!--[if IE 6]>
<script type="text/javascript">
    /*Load jQuery if not already loaded*/ if(typeof jQuery == 'undefined'){ document.write("<script type=\"text/javascript\"   src=\"js/ie6update/jquery.min.js\"></"+"script>"); var __noconflict = true; }
    var IE6UPDATE_OPTIONS = {
        icons_path: "js/ie6update/ie6update/images/"
    }
</script>
<script type="text/javascript" src="js/ie6update/ie6update/ie6update.js"></script>
<![endif]-->
