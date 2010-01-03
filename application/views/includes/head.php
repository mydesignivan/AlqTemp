<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />

<link href="<?=$_SERVER['REQUEST_URI'];?>images/favicon.ico" rel="stylesheet icon" type="image/ico" />
<link href="<?=$_SERVER['REQUEST_URI'];?>styles/style.css" rel="stylesheet" type="text/css" />

<!--[if IE]>
<link href="<?=$_SERVER['REQUEST_URI'];?>styles/styleIE.css" rel="stylesheet" type="text/css" />
<![endif]-->


<script type="text/JavaScript" src="<?=$_SERVER['REQUEST_URI'];?>js/jquery-1.3.2.min.js"></script>

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


<!--[if IE 6]>
<script type="text/javascript">
    /*Load jQuery if not already loaded*/ if(typeof jQuery == 'undefined'){ document.write("<script type=\"text/javascript\"   src=\"js/ie6update/jquery.min.js\"></"+"script>"); var __noconflict = true; }
    var IE6UPDATE_OPTIONS = {
        icons_path: "js/ie6update/ie6update/images/"
    }
</script>
<script type="text/javascript" src="js/ie6update/ie6update/ie6update.js"></script>
<![endif]-->
