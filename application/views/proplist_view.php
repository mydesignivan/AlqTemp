<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/headerpanel_inc.php');?>
        </div><!-- end #header -->
      
        <div id="sidebar1">
            <?php include('includes/banner_inc.php');?>
        </div><!-- end #sidebar1 -->
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top">
                    <h1>Editar Propiedad</h1>
                    <!--<div class="icons">
                        <span>Usuario:</span>
                        Propietario<a href="#"><img src="images/icon_exit.png" border="0" alt="salir" /> Salir</a>
                    </div>-->
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
                                <div class="miniatura"><img src="images/img1.png" alt="propiedades" /></div>
                            </form>
                        </div>
                        <div class="table_center">San Lorenzo Apartments</div>
                        <div class="table_right">Departamentos</div>
                    </div>
                    <div class="table_par">
                        <div class="table_left">
                            <form action="" enctype="application/x-www-form-urlencoded">
                                <input type="checkbox" name="checkbox" id="checkbox" />
                                <div class="miniatura"><img src="images/img1.png" alt="propiedades" /></div>
                            </form>
                        </div>
                        <div class="table_center">Mendoza - Ciudad</div>
                        <div class="table_right">departamentos</div>
                    </div>
                    <div class="table_impar">
                        <div class="table_left">
                            <form action="" enctype="application/x-www-form-urlencoded">
                                <input type="checkbox" name="checkbox" id="checkbox" />
                                <div class="miniatura"><img src="images/img1.png" alt="propiedades" /></div>
                            </form>
                        </div>
                        <div class="table_center">San Lorenzo Apartments</div>
                        <div class="table_right">Departamentos</div>
                    </div>
                </div>
                <!--end .table_body -->
                <div class="table_bottom"></div>
                <br />&nbsp;<br />
            </div>
            <!--end .maintContent -->
        </div>
        <!-- end .container_mainContent -->
      
    	<br class="clearfloat" />
    	
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->
    </div>
    <!-- end #container -->
</body>
</html>