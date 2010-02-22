<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <!--SCRIPT "VALIDADOR DE FORMULARIOS"-->
    <link type="text/css" href="js/jquery.validator/css/style.css" rel="stylesheet"  />
    <script type="text/javascript" src="js/jquery.validator/js/script.js"></script>
    <!--END SCRIPT-->

    <script type="text/javascript" src="js/class.search.min.js"></script>
    <script type="text/javascript" src="js/class.contact.min.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_inc.php');?>
        </div><!-- end #header -->
      
        
        <?php include('includes/banner_inc.php');?>
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>Contacto</h1></div>
                <div class="form_contact">
                    <?php if( $this->session->flashdata('statusmail')=="ok" ){?>
                    <div class="message">
                        <p>Muchas gracias por comunicarse,</p>
                        <p>En breve estaremos en contacto.</p>
                    </div>
                    <?php }elseif( $this->session->flashdata('statusmail')=="error" ){?>

                    <div class="message">
                        <p>Formulario no enviado.</p>
                        <p>Ha ocurrido un error durante el envio del formulario.</p>
                    </div>

                    <?php }else{?>
                    <form id="formContact" action="<?=site_url('/contacto/send');?>" enctype="application/x-www-form-urlencoded" method="post">
                        <div class="form_left">
                            <p>*Nombre:<input type="text" class="input validate" name="txtName" /></p>
                            <p>*E-mail:<input type="text" class="input validate" name="txtEmail" /></p>
                        </div>
                        <div class="form_right">
                            <p>Tel&eacute;fono:<input type="text" class="input" name="txtPhone" /></p>
                            <p>
                                Area de Consulta:<br />
                                <select name="cboArea" class="input">
                                    <option value="jbasaez@mydesign.com.ar">Publicidad</option>
                                    <option value="jbasaez@mydesign.com.ar">Consultas</option>
                                </select>
                            </p>
                        </div>
                        <div class="form_center">
                            <p>
                                *Consulta:<br />
                                <textarea class="input validate" name="txtConsult" rows="22" cols="4"></textarea>
                            </p>
                        </div>
                        <div class="container_button"><a class="button1" href="javascript:void(Contact.send());">Enviar</a></div>
                    </form>

                    <script type="text/javascript">
                    <!--
                        Contact.initializer();
                    -->
                    </script>

                    <br class="clearfloat"/>
                    <h3>(*) Campos Obligatorios</h3>
                    <?php }?>
                 </div>
            </div>
            <!--end .maintContent -->
            <div class="background_bottom"></div>
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
