<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="clear span-24 footer">
    <div class="column-left">
        Copyright &copy; 2009 - 2010 &nbsp; AlquileresTemporarios.org<br/>
        <strong>Dise&ntilde;o y Desarrollo by</strong>
        <a href="http://www.mydesign.com.ar" target="_blank"><img src="images/mydesign_logo.png" alt="www.mydesign.com.ar" /></a>
    </div>

    <div class="column-right">
        <!--<a href="#" class="link1">Site Map</a> | <a href="#" class="link3">Publicidad</a> |--> <a href="<?=site_url('/contacto/');?>" class="link3">Cont&aacute;tenos</a>
        <br />
        <span><a href="<?=site_url('/condicionesdeuso/');?>" class="link3">Condiciones de Uso</a> <!--| <a href="#" class="link3">Pol&iacute;ticas de Privacidad</a>--></span>
    </div>

    <?php if( $this->config->item('banner_visible') ){?>
        <script type="text/javascript">
            var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
            document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
        </script>
        <script type="text/javascript">
            try {
            var pageTracker = _gat._getTracker("UA-818728-6");
            pageTracker._trackPageview();
            } catch(err) {}
        </script>
    <?php }?>
</div>