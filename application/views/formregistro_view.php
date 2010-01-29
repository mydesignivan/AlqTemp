<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>
    <script type="text/javascript" src="js/class.account.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_inc.php');?>
        </div><!-- end #header -->
      
        <div id="sidebar1">
            <?php include('includes/banner_inc.php');?>
        </div><!-- end #sidebar1 -->
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>Registrarme</h1></div>
                <div class="content_left">
                 <?php if( $this->session->flashdata('statusrecord')=='saveok' ){?>
                    <h2>El usuario ha sido creado con &eacute;xito.</h2>
                    <p>En unos segundos se le enviara un email para la activacion del usuario.</p>

                 <?php }else{?>
                    <div id="contmessage"></div>
                    <form name="formAccount" id="formAccount" action="<?=site_url('/registro/create');?>" method="post" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Nombre:</span><input type="text" name="txtName" class="input style_input validate {v_required:true}" /></p>
                        <p><span class="cell">*E-Mail:</span><input type="text" name="txtEmail" class="input style_input validate {v_email:true}" /></p>
                        <p><span class="cell">Teléfono:</span><input type="text" name="txtPhone" class="input style_input" /></p>
                        <p><span class="cell">*Usuario:</span><input type="text" name="txtUser" class="input style_input validate {v_required:true}" /></p>
                        <p><span class="cell">*Contraseña:</span><input type="password" name="txtPass" id="txtPass" class="input style_input validate {v_password:[6,10], v_required:true}" /></p>
                        <p><span class="cell">*Repetir:</span><input type="password" name="txtPass2" class="input style_input validate {v_compare:'txtPass'}" /></p>
                        <p>
                            <div class="cell_captcha">
                                <?php echo $captcha['image'];?>
                                <a href="#" onclick="Account.captcha_show('.cell_captcha img'); return false;">Otro</a>
                            </div>
                        </p>
                        <p><span class="cell">*Ingrese C&oacute;digo:</span><input type="text" name="txtCatcha" id="txtCatcha" class="input style_input validate {v_required:true}" /></p>
                    </form>
                    <div class="container_button"><a class="button1" href="#" onclick="Account.save(); return false;">Enviar</a><img id="ajaxloader" src="images/ajax-loader2.gif" alt="" width="22" height="22" /></div>
                    <h3>&nbsp;</h3>
                    <h3>(*)Campos Obligatorios</h3>
                <?php }?>
                </div>
            </div>
            <!--end .maintContent -->
        </div>
        <!-- end .container_mainContent -->
      
    	<br class="clearfloat" />
      
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->
    </div><!-- end #container -->
</body>
</html>
