<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-10 prepend-left-small">
    <form id="formAccount2" action="<?=site_url('/paneluser/micuenta/delete');?>" method="post" enctype="application/x-www-form-urlencoded">
        <div class="span-15">
            <label class="label-form2 lbl-w2">*Usuario:</label>
            <div class="float-left"><input type="text" name="txtUser" class="input-form validate" /></div>
        </div>
        <div class="span-15">
            <label class="label-form2 lbl-w2">Motivos:</label>
            <textarea name="txtMotive" class="textarea-motive" cols="22" rows="5"></textarea>
        </div>
        <div class="span-15 text-center prepend-top">
            <button type="button" class="button-large" onclick="Account.user_down()">Darme de baja</button>
        </div>
    </form>
</div>

<script type="text/javascript">
<!--
    Account.initializer(false);
-->
</script>
