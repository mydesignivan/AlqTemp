<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <!--SCRIPT "VALIDADOR DE FORMULARIOS"-->
    <link type="text/css" href="js/jquery.validator/css/style.css" rel="stylesheet"  />
    <script type="text/javascript" src="js/jquery.validator/js/script.js"></script>
    <!--END SCRIPT-->

    <script type="text/javascript" src="js/class.account.js"></script>
    <script type="text/javascript" src="js/class.search.min.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_inc.php');?>
        </div><!-- end #header -->
      
        
        <?php include('includes/banner_inc.php');?>
      <?php //$this->session->set_flashdata('statusrecord', "saveok");?>
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>Registrarme</h1></div>
                <div class="content_left">
                 <?php if( $this->session->flashdata('statusrecord')=='saveok' ){?>
                    <h2>El usuario ha sido creado con &eacute;xito.</h2>

                    <p class="message1">Gracias por registrarte, <?=$this->session->flashdata('username');?>. Un correo ha sido enviado a <?=$this->session->flashdata('email');?> con detalles de como activar tu cuenta.</p>

                    <p class="message1">Recibiras un correo en tu bandeja de entrada. Debes seguir el enlace en ese correo antes de logearte.</p>

                 <?php }else{?>

                    <?php require('includes/popup_inc.php');?>

                    <form id="formAccount" action="<?=site_url('/registro/create');?>" method="post" enctype="application/x-www-form-urlencoded">
                        <p><span class="cell">*Nombre:</span><input type="text" name="txtName" class="input style_input validate" /></p>
                        <p><span class="cell">*E-Mail:</span><input type="text" name="txtEmail" class="input style_input validate" /></p>
                        <p><span class="cell">Teléfono:</span><input type="text" name="txtPhone" class="input style_input" /></p>
                        <p><span class="cell">*Usuario:</span><input type="text" name="txtUser" class="input style_input validate" /></p>
                        <p><span class="cell">*Contraseña:</span><input type="password" name="txtPass" class="input style_input validate" /></p>
                        <p><span class="cell">*Repetir:</span><input type="password" name="txtPass2" class="input style_input validate" /></p>
                        <p>
                            <div class="cell_captcha">
                                <div class="cell">
                                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
                                        <param name="allowScriptAccess" value="sameDomain" />
                                        <param name="allowFullScreen" value="false" />
                                        <param name="movie" value="images/securimage_play.swf?audio=<?=site_url('/captcha/play/');?>&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
                                        <param name="quality" value="high" />
                                        <param name="bgcolor" value="#ffffff" />
                                        <embed src="images/securimage_play.swf?audio=<?=site_url('/captcha/play/');?>&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                                    </object>
                                    <br />
                                    <a href="javascript:void($('#imgCaptcha').attr('src', '<?=site_url('/captcha/index/');?>/'+Math.random()));" tabindex="-1" title="Mostrar otro"><img src="images/refresh.gif" alt="Mostrar otro" border="0" onclick="this.blur()" align="bottom" /></a>
                                </div>
                                <img id="imgCaptcha" src="<?=site_url('/captcha/index/'.md5(time()));?>" align="left" border="0" alt="" />

                            </div>
                        </p>
                        <p><span class="cell">*Ingrese C&oacute;digo:</span><input type="text" name="txtCaptcha" class="input style_input validate" /></p>
                    </form>
                    <div class="container_button3"><a class="button1" href="javascript:void(Account.save());">Enviar</a></div>
                    <br class="clearfloat" />
                    <h3>(*)Campos Obligatorios</h3>
                <?php }?>

                    <script type="text/javascript">
                    <!--
                        Account.initializer();
                    -->
                    </script>
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
    </div><!-- end #container -->
</body>
</html>
