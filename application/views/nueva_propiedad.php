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
      <?php include ('includes/header_panel.php');?>
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
                	<h1>Nueva Propiedad</h1>
                	<div class="icons">
                    <span>Usuario:</span>Propietario<a href="#"><img src="images/icon_exit.png" border="0" alt="salir" /> Salir</a>
                    </div>
                </div>
              <div class="content_left">
                    <form action="" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Dirección:</span><input type="text" class="input style_input" /></p>
                      	<!--<p>
                        	<span class="cell">*Foto:</span>
                            <input type="file" name="fileField" class="input" />
                            <a href="#" class="add">Adjuntar otro archivo</a>
                        </p>-->
                   	  	<p><span class="cell">*Descripci&oacute;n:</span>
                   	    <textarea class="input style_textarea" cols="20" rows="5"></textarea>
                   	  	</p>
                   	  	<p>
                      	<span class="cell">*Servicios:</span>
                      	<div class="list input">
                        	<ul>
                            	<li class="impar"><input type="checkbox" name="checkbox" class="checkbox" /><span>Salon de reuni&oacute;n</span>
                                </li>
                              	<li><input type="checkbox" name="checkbox" class="checkbox" /><span>Secador de pelo</span></li>
                                <li class="impar"><input type="checkbox" name="checkbox" class="checkbox" /><span>Aire acondicionado</span></li>
                                <li><input type="checkbox" name="checkbox" class="checkbox" /><span>Calefacci&oacute;n</span></li>
                                <li class="impar"><input type="checkbox" name="checkbox" class="checkbox" /><span>Aire acondicionado</span></li>
                                <li><input type="checkbox" name="checkbox" class="checkbox" /><span>Calefacci&oacute;n</span></li>
                                <li class="impar"><input type="checkbox" name="checkbox" class="checkbox" /><span>Aire acondicionado</span></li>
                            </ul>
                   	  	</div>
                      	</p>
                      	<p><span class="cell">*Pais:</span><input type="password" class="input style_input" />
                        </p>
                        <p><span class="cell">*Provincia</span><input type="password" class="input style_input" />
                        </p>
                        <p><span class="cell">*Ciudad:</span><input type="password" class="input style_input" />
                        </p>
                        <p><span class="cell">Tel&eacute;fono:</span><input type="password" class="input style_input" />
                      	</p>
                        <p><span class="cell">P&aacute;gina Web:</span><input type="password" class="input style_input" />
                      	</p>
                        <p><span class="cell">Precio:</span><input type="password" class="input style_input" />
                      	</p>
                    </form>
              		<p>
                    <div class="container_button">
                       <a class="button1" href="#">Guardar</a>
                 	</div>
                    </p>
                    <div class="warning"><h3>(*) Campos Obligatorios </h3></div>
                </div><!--end .content_left -->
           </div><!--end .maintContent -->
      </div><!-- end .container_mainContent -->
      
      
    	<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos --><br class="clearfloat" />
    	
      
      <div id="footer">
      <?php include ('includes/footer.php');?>
      </div><!-- end #footer -->
    </div><!-- end #container -->
    </body>
</html>
