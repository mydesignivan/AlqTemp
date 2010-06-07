<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-10 prepend-left-small">
    <?php require(APPPATH . 'views/includes/popup1_inc.php');?>
    <?php require(APPPATH . 'views/includes/popup2_inc.php');?>

    <form id="formAccount" action="<?=site_url('/paneluser/micuenta/edit');?>" method="post" enctype="application/x-www-form-urlencoded">
        <div class="span-15">
            <label class="label-form2 lbl-w1">*Nombre:</label>
            <div class="float-left"><input type="text" name="txtFirstName" class="input-form validate" tabindex="3" value="<?=$info['firstname'];?>" /></div>
        </div>
        <div class="span-15 clear">
            <label class="label-form2 lbl-w1">*Apellido:</label>
            <div class="float-left"><input type="text" name="txtLastName" class="input-form validate" tabindex="4" value="<?=$info['lastname'];?>" /></div>
        </div>
        <div class="span-15 clear">
            <label class="label-form2 lbl-w1">*Email:</label>
            <div class="float-left"><input type="text" name="txtEmail" class="input-form validate" tabindex="5" value="<?=$info['email'];?>" onblur="$(this).ucLower();" /></div>
        </div>
        <div class="span-15 clear">
            <label class="label-form2 lbl-w1">Tel&eacute;fono:</label>
            <input type="text" name="txtPhoneArea" class="input-phonearea" tabindex="6" value="<?=$info['phone_area'];?>" />
            <input type="text" name="txtPhone" class="input-phone" tabindex="7" value="<?=$info['phone'];?>" />
        </div>
        <div class="span-15 clear">
            <label class="label-form2 lbl-w1">*Usuario:</label>
            <div class="float-left"><input type="text" name="txtUser" class="input-form validate" tabindex="8" value="<?=$info['username'];?>" /></div>
        </div>
        <div class="span-15 clear">
            <label class="label-form2 lbl-w1">Contrase&ntilde;a:</label>
            <input type="password" name="txtPass" class="input-pss float-left" tabindex="9" value="XXXXXXXXXX" disabled />&nbsp;
            <a href="javascript:void(Account.open_popup.editpss())" class="link2 float-left">&nbsp;Modificar</a>
        </div>
        <!-- ======= END FORM ======= -->
        
        <div class="clear span-15 text-center prepend-top">
            <button type="button" class="button-large" onclick="Account.save();">Guardar</button>            
        </div>

        <div class="span-15 clear">
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
