<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alquileres temporarios</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<!--[if IE]>
<link href="styles/styleIE.css" rel="stylesheet" type="text/css" />
<![endif]-->
    
    <script type="text/JavaScript" src="js/curvycorners.js"></script>
    <script type="text/JavaScript">

  /*addEvent(window, 'load', initCorners);

  function initCorners() {
    var settings = {
      tl: { radius: 20 },
      tr: { radius: 0 },
      bl: { radius: 20 },
      br: { radius: 0 },
      antiAlias: true
    }
	curvyCorners(settings, "#mainContent,.mainContent2");
  	}*/
  
</script>
</head>

<body>

    <div id="container">
      <div id="header">
      	<?php include ('includes/header.php');?>
      </div><!-- end #header -->
      
      <div id="sidebar1">
      	<div class="publicity_horizontal">publicidad</div>
        <div class="publicity_horizontal">publicidad</div>
        <div class="publicity_horizontal">publicidad</div>
        <div class="publicity_horizontal">publicidad</div>
        <div class="publicity_horizontal">publicidad</div>
        <div class="publicity_horizontal">publicidad</div>
        <div class="publicity_horizontal">publicidad</div>        
      </div><!-- end #sidebar1 -->
      
      <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top">
                  <h1>Registrarrme</h1>
                </div>
                <div class="content_left">
                    <form action="" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Nombre:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">*E-Mail:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">Teléfono:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">*Usuario:</span><input type="text" class="input style_input" /></p>
                        <p><span class="cell">*Contraseña:</span><input type="password" class="input style_input" /></p>
                        <p><span class="cell">*Repetir:</span><input type="text" class="input style_input" /></p>
                        <p><div class="cell_cache"><img src="js/catcha/securimage_show.php?sid=<? echo md5(uniqid(time()));?>" id="image" alt="" width="150" /><a class="otra" href="#" onclick="document.getElementById('image').src = 'js/catcha/securimage_show.php?sid=' + Math.random(); return false">(Otra)</a>&nbsp;</div></p>
                        
                        <p><span class="cell">*Ingresar C&oacute;digo:</span><input type="text" class="input style_input" /></p>
                    </form>
                    <div class="container_button">
                        <a class="button1" href="#">Enviar</a>
                    </div>
                  <h3>&nbsp;</h3>
                  <h3>(*)Campos Obligatorios</h3>
              </div>
        </div><!--end .maintContent -->
      </div><!-- end .container_mainContent -->
      
      
    	<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos --><br class="clearfloat" />
    	
      
      <div id="footer">
      <?php include ('includes/footer.php');?>
      </div><!-- end #footer -->
    </div><!-- end #container -->
    </body>
</html>
