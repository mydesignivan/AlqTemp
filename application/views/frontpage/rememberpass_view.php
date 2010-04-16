<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<form id="form1" action="<?=site_url('/recordarcontrasenia/send/');?>" method="post" enctype="application/x-www-form-urlencoded">
<?php if( @$status=="ok" ){?>
    <p>Muy bien, le hemos enviado las instrucciones a su email. Reviselo!</p>
    <p>Usted puede mantener esta pagina abierta mientras chequea su email. Si usted no recibe las instrucciones en el transcurso de un minuto o dos pruebe <a href="javascript:$('#form1').submit();">Reenviar las instrucciones</a></p>
    <input type="hidden" name="txtField" value="<?=$field;?>" />

<?php }else{?>
    <h2>¿Olvido su Contraseña?</h2>
    <p>AlquileresTemporarios.org le enviara las instrucciones para resetear su contrase&ntilde;a a la direcci&oacute;n de correo asociada a su cuenta.</p>
    <p>Por favor escriba su direcci&oacute;n de <b>email</b> o su <b>usuario</b> a continuaci&oacute;n.</p>

    <div class="span-9 last">
        <label class="label-form float-left">Email / Usuario&nbsp;</label>
        <input type="text" name="txtField" class="input-form float-right validate" value="<?=@$_POST['txtField'];?>" />
        <div id="msgbox-field"></div>
    </div>

    <div class="span-9 clear prepend-top">
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
        <img id="imgCaptcha" src="<?=site_url('/captcha/index/'.md5(time()));?>" align="left" width="180" height="65" alt="" class="float-right img-captcha" />
    </div>
    <div class="span-9 clear">
        <label class="label-form float-left">*Ingrese C&oacute;digo:</label>
        <input type="text" name="txtCaptcha" maxlength="6" class="input-captcha validate" tabindex="11" />
    </div>
    <!-- ======= END FORM ======= -->

    <div class="span-15 text-center prepend-top">
        <button type="button" class="button-small" onclick="RememberPass.send();">Enviar</button>
    </div>
<?php }?>
</form>

<script type="text/javascript">
<!--
    RememberPass.initializer('<?=@$status;?>');
-->
</script>
