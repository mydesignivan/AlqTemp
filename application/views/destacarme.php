<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head.php');?>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_panel.php');?>
        </div><!-- end #header -->
      
        <div id="sidebar1">
            <?php include('includes/banner.php');?>
        </div><!-- end #sidebar1 -->
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top">
                    <h1>Destacarme</h1>
                    <div class="icons">
                        <span>Usuario:</span>
                        Propietario<a href="#"><img src="images/icon_exit.png" alt="salir" /> Salir</a>
                    </div>
                </div>
                <div class="credit">
                    <div class="credit_attention">El posicionamiento de la propiedad <span class="t2">se realizar&aacute; unicamente para la secci&oacute;n elegida</span> y la <span class="t2">propiedad seleccionada.</span> La duraci&oacute;n de la posici&oacute;n ser&aacute; de <span class="t2">3 meses</span> desde la fecha de contrataci&oacute;n.</div>
                </div>
                <div class="selection">
                    <div class="selection_left">
                        Destacarme en <span>la p&aacute;gina de Inicio: </span><br />
                        <form action="" enctype="application/x-www-form-urlencoded">
                            <label><input type="radio" name="GrupoOpciones1" value="opción" id="GrupoOpciones1_0" />Si</label>
                            <label><input type="radio" name="GrupoOpciones1" value="opción" id="GrupoOpciones1_1" />No</label>
                        </form>
               	    </div>
                    <div class="selection_right">
                    	<form action="" enctype="application/x-www-form-urlencoded">
                            Destacarme en la <span>Categor&iacute;a</span>
                            <select name="select" class="input style_input">
                                <option>Casas</option>
                                <option>Departamentos</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="header">
                    <div class="header_left">Imagen</div>
                    <div class="header_center">Ubicaci&oacute;n</div>
                    <div class="header_right">Categor&iacute;a</div>
                </div>
                <div class="container_scroll table_body">
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
                                <div class="miniatura"><img src="images/img1.png" alt="propiedades" border="0" /></div>
                            </form>
                        </div>
                        <div class="table_center">San Lorenzo Apartments</div>
                        <div class="table_right">Departamentos</div>
                    </div>
                </div>
                <div class="table_bottom"></div>

                <div class="container_button"><a href="#" class="button2">Canjear Puntos</a></div>

                <br />&nbsp;<br />

                <div class="selection">
                    <h2>Propiedades que ya han sido destacadas</h2>
                    <p>Seleccione las propiedades <br />que desea eliminar del destacado</p>
                </div>

                <div class="header">
                    <div class="header_left">Imagen</div>
                    <div class="header_center">Ubicaci&oacute;n</div>
                    <div class="header_right">Categor&iacute;a</div>
                </div>
                <div class="container_scroll table_body">
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
                <div class="table_bottom"></div>

                <div class="container_button">
                    <a href="#" class="button1">Eliminar</a>
                </div>
             </div>
            <!--end .maintContent -->
        </div>
        <!-- end .container_mainContent -->
      
    	<br class="clearfloat" />
      
        <div id="footer">
            <?php include ('includes/footer.php');?>
        </div><!-- end #footer -->

    </div>
    <!-- end #container -->
</body>
</html>