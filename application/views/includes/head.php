<base href="<?=base_url();?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />

<link href="images/favicon.ico" rel="stylesheet icon" type="image/ico" />
<link href="styles/style.css" rel="stylesheet" type="text/css" />

<!--[if IE]>
<link href="styles/styleIE.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--========== LIBRARIES ============-->
<script type="text/JavaScript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/helpers.js"></script>
<!--========== END LIBRARIES =======-->


<!--============ SCRIPT: SUPERFISH (Menus Desplegables) =================-->
<!--<link rel="stylesheet" type="text/css" href="js/jquery.superfish/css/superfish.css" media="screen">
<script type="text/javascript" src="js/jquery.superfish/js/hoverIntent.js"></script>
<script type="text/javascript" src="js/jquery.superfish/js/superfish.js"></script>
<script type="text/javascript">
    jQuery(function(){
        jQuery('ul.sf-menu').superfish();
    });
</script>-->
<!--======= END SCRIPT =======-->

<!--============ SCRIPT: JQuery Validator =================-->
<link href="js/jquery.validator/css/jquery.validate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.validator/js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.validator/js/jquery.validate.messages.js"></script>
<script type="text/javascript" src="js/jquery.validator/js/execute.js"></script>
<!--======= END SCRIPT =======-->



<!--========== CLASS ============-->
<script type="text/javascript" src="js/class.login.js"></script>

<!--======= END CLASS =======-->

<?php if( $this->session->flashdata('logout') ) {?>
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
