<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alquileres temporarios</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<!--[if IE 5]>
    <style type="text/css"> 
    /* coloque las reparaciones del modelo de cuadro para IE 5* en este comentario condicional */
    .twoColFixRtHdr #sidebar1 { width: 220px; }
    </style>
    <![endif]--><!--[if IE]>
    <style type="text/css"> 
    /* coloque las reparaciones de css para todas las versiones de IE en este comentario condicional */
    .twoColFixRtHdr #sidebar1 { padding-top: 30px; }
    .twoColFixRtHdr #mainContent { zoom: 1; }
    /* la propiedad zoom propia que se indica más arriba proporciona a IE el hasLayout que necesita para evitar diversos errores */
    </style>
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
                <div class="content_top">
                	<h1>Editar Propiedad</h1>
                	<div class="icons">
                    <span>Usuario:</span>Propietario<a href="#"><img src="images/icon_exit.png" border="0" alt="salir" /> Salir</a>
                    </div>
                </div>
                <div class="buttons">
                    <a href="#" class="button1">Modificar</a>
                    <a href="#" class="button1">Eliminar</a>
                </div>
                <div class="header">
                	<div class="header_left">Imagen</div>
                    <div class="header_center">Ubicaci&oacute;n</div>
                    <div class="header_right">Categor&iacute;a</div>
                </div>
                <div class="table_body">
                    <div class="table_impar">
                        <div class="table_left">
                            <form action="" enctype="application/x-www-form-urlencoded">
                                <input type="checkbox" name="checkbox" id="checkbox" />
                                <div class="miniatura"><img src="images/img1.png" alt="propiedades" border="0" />
                                </div>
                            </form>
                        </div>
                        <div class="table_center">San Lorenzo Apartments</div>
                        <div class="table_right">Departamentos</div>
                    </div>
                    <div class="table_par">
                        <div class="table_left">
                            <form action="" enctype="application/x-www-form-urlencoded">
                                <input type="checkbox" name="checkbox" id="checkbox" />
                                <div class="miniatura"><img src="images/img1.png" alt="propiedades" border="0" />
                                </div>
                            </form>
                        </div>
                        <div class="table_center">Mendoza - Ciudad</div>
                        <div class="table_right">departamentos</div>
                    </div>
                    <div class="table_impar">
                        <div class="table_left">
                            <form action="" enctype="application/x-www-form-urlencoded">
                                <input type="checkbox" name="checkbox" id="checkbox" />
                                <div class="miniatura"><img src="images/img1.png" alt="propiedades" border="0" />
                                </div>
                            </form>
                        </div>
                        <div class="table_center">San Lorenzo Apartments</div>
                        <div class="table_right">Departamentos</div>
                    </div>
                </div><!--end .table_body -->
                <div class="table_bottom"></div>
                <br />&nbsp;<br />
            </div><!--end .maintContent -->
      </div><!-- end .container_mainContent -->
      
      
    	<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos --><br class="clearfloat" />
    	
      
      <div id="footer">
      <?php include ('includes/footer.php');?>
      </div><!-- end #footer -->
    </div><!-- end #container -->
    </body>
</html>
