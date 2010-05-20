<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-10 prepend-left-small">
    <form id="formAccount2" action="<?=site_url('/paneluser/micuenta/delete');?>" method="post" enctype="application/x-www-form-urlencoded">
        <div class="span-8">
            <label class="label-form float-left">*Usuario:</label>
            <input type="text" name="txtUser" class="input-form float-right validate" />
        </div>
        <div class="span-10">
            <label class="label-form">Motivos:</label>
            <textarea name="txtMotive" class="textarea-motive float-right" cols="22" rows="5"></textarea>
        </div>
        <div class="span-10 text-center prepend-top">
            <button type="button" class="button-large" onclick="Account.user_down()">Darme de baja</button>
        </div>
    </form>
</div>

<script type="text/javascript">
<!--
    Account.initializer(false);
-->
</script>
