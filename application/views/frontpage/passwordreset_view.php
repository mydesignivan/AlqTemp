<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php if( @$status=="ok" ){?>
        <form id="form3" action="<?=site_url('/login/account_access/');?>" method="post">
            <p>
                Muy Bien! Su contrase&ntilde;a ha sido cambiada!<br />
                Por favor asegurese de memorizarla o anotarla en un lugar seguro.
            </p>
            <br />
            <a href="javascript:$('form3').submit();" class="link-title">Acceder a su cuenta</a>

            <input type="hidden" name="p1" value="<?=$info['username'];?>" />
            <input type="hidden" name="p2" value="<?=$info['password'];?>" />
        </form>

<?php }else{?>
        <form id="form2" action="<?=site_url('/recordarcontrasenia/send_newpass/'.$this->uri->segment(3)."/".$this->uri->segment(4));?>" method="post">
            <p>
                Cambie su Contrase&ntilde;a<br />
                Por favor, elija una contrase&ntilde;a para usar con su cuenta de AlquileresTemporarios.org
            </p>

            <div class="span-11">
                <label class="label-form float-left">Nueva Contrase&ntilde;a:</label>
                <input type="password" name="txtPass" id="txtPass" class="input-form float-right validate" />
            </div>
            <div class="clear span-11">
                <label class="label-form float-left">Verifique Nueva Contrase&ntilde;a:</label>
                <input type="password" name="txtPass2" class="input-form float-right validate" />
            </div>

            <div class="span-15 text-center prepend-top">
                <button type="button" onclick="RememberPass.send();" class="button-small">Cambiar</button>
            </div>
            <!-- ======= END FORM ======= -->

            <input type="hidden" name="usr" value="<?=@$username;?>" />
            <input type="hidden" name="token" value="<?=@$token;?>" />
        </form>
        <script type="text/javascript">
        <!--
            RememberPass.initializer();
        -->
        </script>
<?php }?>