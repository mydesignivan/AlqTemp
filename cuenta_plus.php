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

  addEvent(window, 'load', initCorners);

  function initCorners() {
    var settings = {
      tl: { radius: 20 },
      tr: { radius: 0 },
      bl: { radius: 20 },
      br: { radius: 0 },
      antiAlias: true
    }
	curvyCorners(settings, "#mainContent,.mainContent2");
  	}
  
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
            <div class="content_top"><h1>Cuenta Plus</h1>
            	<div class="icons"><span>Usuario:</span>Propietario<a href="#"><img src="images/icon_exit.png" border="0" alt="salir" /> Salir</a>
                </div>
            </div>
            <div class="container_center">
				<div class="plus1"><span class="t1">"Canjee Cr&eacute;ditos</span> y podr&aacute; obtener su <span class="t1">CUENTA PLUS</span><br />permitiendole acceder a servicios adicionales<span class="t1">"</span>
                </div>
                <div class="plus2">
					<div class="plus2_top">Algunos Beneficios de su CUENTA PLUS
                    </div>
                        <div class="plus2_bottom">
                        	<ul>
                            	<li>Cargar hasta <span class="t2">10 propiedades.</span></li>
                                <li>Agregar hasta <span class="t2">8 fotos por propiedad.</span></li>
                                <li>Ubicar su propiedad en un <span class="t2">mapa de google.</span></li><br /><span class="t2">y MUCHO M&Aacute;S!!!</span>
                            </ul>
						</div>
					</div><!--end .plus2 -->
                    <div class="container_button"><a class="button2" href="#">Canjear Puntos</a>
                    </div>
                </div><!--end .container_center -->
            </div><!--end .maintContent -->
        </div><!-- end .container_mainContent -->
      
      
    	<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos --><br class="clearfloat" />
    	
      
      <div id="footer">
      <?php include ('includes/footer.php');?>
      </div><!-- end #footer -->
    </div><!-- end #container -->
    </body>
</html>
