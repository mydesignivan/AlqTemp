<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-10 prepend-left-small">
    <?php require(APPPATH . 'views/includes/popup4_inc.php');?>

    <form id="formAccount" action="<?=site_url('/paneluser/micuenta/edit');?>" method="post" enctype="application/x-www-form-urlencoded">
        <div class="span-10">
            <label class="label-form float-left">*Nombre:</label>
            <input type="text" name="txtFirstName" class="input-form float-right validate" tabindex="3" value="<?=$info['firstname'];?>" />
        </div>
        <div class="span-10 clear">
            <label class="label-form float-left">*Apellido:</label>
            <input type="text" name="txtLastName" class="input-form float-right validate" tabindex="4" value="<?=$info['lastname'];?>" />
        </div>
        <div class="span-10 clear">
            <label class="label-form float-left">*Email:</label>
            <input type="text" name="txtEmail" class="input-form float-right validate" tabindex="5" value="<?=$info['email'];?>" />
        </div>
        <div class="span-10 clear">
            <label class="label-form float-left">Tel&eacute;fono:</label>
            <input type="text" name="txtPhone" class="input-phone float-right" tabindex="7" value="<?=$info['phone'];?>" />
            <input type="text" name="txtPhoneArea" class="input-phonearea float-right" tabindex="6" value="<?=$info['phone_area'];?>" />
        </div>
        <div class="span-10 clear">
            <label class="label-form float-left">*Usuario:</label>
            <input type="text" name="txtUser" class="input-form float-right validate" tabindex="8" value="<?=$info['username'];?>" />
        </div>
        <div class="span-10 clear">
            <label class="label-form float-left">Contrase&ntilde;a:</label>
            <a href="javascript:void(Account.open_popup.editpss())" class="link2 float-right">&nbsp;Modificar</a>
            <input type="password" name="txtPass" class="input-pss float-right" tabindex="9" value="XXXXXXXXXX" disabled />&nbsp;
        </div>
        <!-- ======= END FORM ======= -->
        
        <div class="clear span-15 text-center prepend-top">
            <button type="button" class="button-large" onclick="Account.save();">Guardar</button>            
        </div>

        <div class="span-15 clear">
            <label class="label-legend">(*) Campo obligatorios</label>
            <a href="<?=site_url('/paneluser/micuenta/baja')?>" class="link2 float-right">Darse de baja</a>
        </div>

        <input type="hidden" name="user_id" value="<?=$info['user_id'];?>" />
    </form>
</div>

<!--<div class="span-4 last prepend-1">
    <br /><br /><br />
    <label class="label-large">Saldo Disponible</label><br />
    <input type="text" class="input-saldo" value="U$S <?=$this->session->userdata('fondo');?>" onkeypress="return false;" />
</div>-->

<script type="text/javascript">
<!--
    Account.initializer(true);
-->
</script>
