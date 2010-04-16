<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php if( $this->session->flashdata('statusrecord')=='saveok' ){?>

        <h2>El usuario ha sido creado con &eacute;xito.</h2>
        <p>Gracias por registrarte, <?=$this->session->flashdata('username');?>. Un correo ha sido enviado a <?=$this->session->flashdata('email');?> con detalles de como activar tu cuenta.</p><br />
        <p>Recibiras un correo en tu bandeja de entrada. Debes seguir el enlace en ese correo antes de logearte.</p>


<?php }else{?>

        <form id="formAccount" class="prepend-left-small" action="<?=site_url('/registro/create/');?>" method="post" enctype="application/x-www-form-urlencoded">
            <?php require(APPPATH . 'views/includes/popup_inc.php');?>

            <div class="span-10">
                <label class="label-form float-left">*Nombre:</label>
                <input type="text" name="txtFirstName" class="input-form float-right validate" tabindex="3" />
            </div>
            <div class="span-10 clear">
                <label class="label-form float-left">*Apellido:</label>
                <input type="text" name="txtLastName" class="input-form float-right validate" tabindex="4" />
            </div>
            <div class="span-10 clear">
                <label class="label-form float-left">*Email:</label>
                <input type="text" name="txtEmail" class="input-form float-right validate" tabindex="5" />
            </div>
            <div class="span-10 clear">
                <label class="label-form float-left">Tel&eacute;fono:</label>
                <input type="text" name="txtPhone" class="input-phone float-right" tabindex="7" />
                <input type="text" name="txtPhoneArea" class="input-phonearea float-right" tabindex="6" />
            </div>
            <div class="span-10 clear">
                <label class="label-form float-left">*Usuario:</label>
                <input type="text" name="txtUser" class="input-form float-right validate" tabindex="8" />
            </div>
            <div class="span-10 clear">
                <label class="label-form float-left">*Password:</label>
                <input type="password" name="txtPass" class="input-form float-right validate" tabindex="9" />
            </div>
            <div class="span-10 clear">
                <label class="label-form float-left">*Repetir Contrase&ntilde;a:</label>
                <input type="password" name="txtPass2" class="input-form float-right validate" tabindex="10" />
            </div>

            <div class="span-10 clear prepend-top">
                <div class="float-right">
                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="19" height="19" id="SecurImage_as3" align="middle">
                        <param name="allowScriptAccess" value="sameDomain" />
                        <param name="allowFullScreen" value="false" />
                        <param name="movie" value="images/securimage_play.swf?audio=<?=site_url('/captcha/play/');?>&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" />
                        <param name="quality" value="high" />
                        <param name="bgcolor" value="#ffffff" />
                        <param name="wmode" value="transparent" />
                        <embed src="images/securimage_play.swf?audio=<?=site_url('/captcha/play/');?>&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5" quality="high" bgcolor="#ffffff" width="19" height="19" name="SecurImage_as3" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="transparent" />
                    </object><br />
                    <a href="javascript:void($('#imgCaptcha').attr('src', '<?=str_replace(".html", "", site_url('/captcha/index/'));?>/'+Math.random()));" tabindex="-1" title="Mostrar otro"><img src="images/icon_refresh.gif" alt="Mostrar otro" onclick="this.blur()" align="bottom" /></a>
                </div>
                <img id="imgCaptcha" src="<?=site_url('/captcha/index/'.md5(time()));?>" align="left" width="180" height="65" alt="" class="img-captcha float-right" />
            </div>
            <div class="span-10 clear">
                <label class="label-form float-left">*Ingrese C&oacute;digo:</label>
                <input type="text" name="txtCaptcha" maxlength="6" class="input-captcha validate" tabindex="11" />
            </div>
            <!-- ======= END FORM ======= -->

            <div class="clear span-15 text-center prepend-top">
                <button type="button" class="button-large" onclick="Account.save();">Registrarme</button>
            </div>

            <div class="span-10 clear"><label class="label-legend">(*) Campo obligatorios</label></div>
        </form>

        <script type="text/javascript">
        <!--
            Account.initializer(false);
        -->
        </script>
<?php }?>