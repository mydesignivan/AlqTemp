<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head.php');?>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header.php');?>
        </div><!-- end #header -->
      
        <div id="sidebar1">
            <?php include('includes/banner.php');?>
        </div><!-- end #sidebar1 -->
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>Contacto</h1></div>
                <div class="form_contact">
                    <div class="form_left">
                        <form action="" enctype="application/x-www-form-urlencoded">
                            <p>Nombre:<input type="text" class="input" /></p>
                            <p>E-mail:<input type="text" class="input" /></p>
                        </form>
                    </div>
                    <div class="form_right">
                    	<form action="" enctype="application/x-www-form-urlencoded">
                            <p>Tel&eacute;fono:<input type="text" class="input" /></p>
                            <p>
                                Area de Consulta:<br />
                                <select name="select" class="input"></select>
                            </p>
                        </form>
                    </div>
                    <div class="form_center">
                    	<form action="" enctype="application/x-www-form-urlencoded">
                            <p>
                                Consulta:<br />
                                <input type="text" class="input" />
                            </p>
                        </form>
                    </div>
                    <div class="container_button">
                        <a class="button1" href="#">Enviar</a>
                    </div>
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
