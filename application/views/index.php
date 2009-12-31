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
                  <h1>Alquileres Destacados</h1>
                </div>
                <div class="description_properties">
                    <div class="image_properties"><img src="images/image_properties1.png" /></div>
                    <div class="description_text"><h2>San Lorenzo Apartments</h2>
                        <p>Ajkljlkjeqw jlkjadk wqe jklasd lkjalsdjasd klñkñalskd alkasd jka dasdas.</p>
                        <b>Categor&iacute;a:</b> Departamentos <br />
                        <b>Ciudad:</b> Mendoza 
                        <span><br />Precio: $250</span><a class="info" href="#">Mas info</a></p>
                    </div>
                </div>
            
                <div class="description_properties">
                    <div class="image_properties"><img src="images/image_properties1.png" /></div>
                    <div class="description_text"><h2>San Lorenzo Apartments</h2>
                        <p>Ajkljlkjeqw jlkjadk wqe jklasd lkjalsdjasd klñkñalskd alkasd jka dasdas.</p>
                        <b>Categor&iacute;a:</b> Departamentos <br />
                        <b>Ciudad:</b> Mendoza 
                      <span><br />Precio: $250</span><a class="info" href="#">Mas info</a></p>
                    </div>
                </div>
                
                <div class="description_properties">
                    <div class="image_properties"><img src="images/image_properties1.png" /></div>
                    <div class="description_text"><h2>San Lorenzo Apartments</h2>
                        <p>Ajkljlkjeqw jlkjadk wqe jklasd lkjalsdjasd klñkñalskd alkasd jka dasdas.</p>
                        <b>Categor&iacute;a:</b> Departamentos <br />
                        <b>Ciudad:</b> Mendoza 
                        <span><br />Precio: $250</span><a class="info" href="#">Mas info</a></p>
                    </div>
                </div>
          </div><!-- end #mainContent -->
      
      
    	<!-- Este elemento de eliminación siempre debe ir inmediatamente después del div #mainContent para forzar al div #container a que contenga todos los elementos flotantes hijos --><br class="clearfloat" />
        
            <div class="mainContent2">
                <div class="content_top"><h1>Destinos mas Buscados</h1></div>
                <div class="destinations">
                    <div class="column line_right">
                        <ul>
                        <li>Mar del Plata</li>
                        <li>Mar del Plata</li>
                        <li>Mar del Plata</li>
                        <li>Mar del Plata</li>
                        </ul>
                    </div>
                    <div class="column line_right">
                        <ul>
                        <li>Mar del Plata</li>
                        <li>Mar del Plata</li>
                        <li>Mar del Plata</li>
                        <li>Mar del Plata</li>
                        </ul>
                    </div>
                    <div class="column">
                        <ul>
                        <li>Mar del Plata</li>
                        <li>Mar del Plata</li>
                        <li>Mar del Plata</li>
                        <li>Mar del Plata</li>
                        </ul>
                    </div>
                </div>
                <h2>&nbsp;</h2>
            </div>
      </div> <!--end .container_mainContent-->
      
      
      <div id="footer">
      <?php include ('includes/footer.php');?>
      </div><!-- end #footer -->
    </div><!-- end #container -->
    </body>
</html>
