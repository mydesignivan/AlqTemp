<base href="<?=base_url();?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="images/favicon.ico" rel="stylesheet icon" type="image/ico" />
<link href="styles/style.css" rel="stylesheet" type="text/css" />

<!--[if IE]>
<link href="styles/styleIE.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--========== LIBRARIES ============-->
<script type="text/JavaScript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/helpers.min.js"></script>
<script type="text/javascript" src="js/comun.js"></script>
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

<script type="text/javascript">
<!--
<?php 
    $indexphp = index_page();
    if( !empty($indexphp) ) $indexphp.="/";
?>
    var baseURI = $("base").attr("href")+"<?=$indexphp;?>";
-->
</script>

<!--========== CLASS ============-->
<script type="text/javascript" src="js/class.login.js"></script>
<!--======= END CLASS =======-->


<!--[if IE 6]>
<script type="text/javascript">
    /*Load jQuery if not already loaded*/ if(typeof jQuery == 'undefined'){ document.write("<script type=\"text/javascript\"   src=\"js/ie6update/jquery.min.js\"></"+"script>"); var __noconflict = true; }
    var IE6UPDATE_OPTIONS = {
        icons_path: "js/ie6update/ie6update/images/"
    }
</script>
<script type="text/javascript" src="js/ie6update/ie6update/ie6update.js"></script>
<![endif]-->

<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG.js"></script>
<![endif]-->

<?php $execscript=true;?>