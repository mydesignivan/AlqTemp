<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <script type="text/javascript" src="js/class.contact.js"></script>
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
                    <form name="formContact" id="formContact" action="<?=site_url('/contacto/send');?>" enctype="application/x-www-form-urlencoded" method="post">
                        <div class="form_left">
                            <p>*Nombre:<input type="text" class="input validate {v_required:true}" name="txtName" /></p>
                            <p>*E-mail:<input type="text" class="input validate {v_required:true, v_email:true}" name="txtEmail" /></p>
                        </div>
                        <div class="form_right">
                            <p>Tel&eacute;fono:<input type="text" class="input" name="txtPhone" /></p>
                            <p>
                                Area de Consulta:<br />
                                <select name="cboArea" class="input">
                                </select>
                            </p>
                        </div>
                        <div class="form_center">
                            <p>
                                *Consulta:<br />
                                <textarea class="input validate {v_required:true}" name="txtConsult" rows="22" cols="4"></textarea>
                            </p>
                        </div>
                        <div class="container_button"><a class="button1" href="#" onclick="Contact.send(); return false;">Enviar</a></div>
                    </form>
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
