<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-10 prepend-left-small">
    <form id="form1" action="" method="post" enctype="application/x-www-form-urlencoded">
        <?php require(APPPATH . 'views/includes/popup1_inc.php');?>

        <div class="span-10">
            <label class="label-form float-left">*Nombre:&nbsp;&nbsp;&nbsp;</label>
            <input type="text" name="txtName" class="input-form float-left validate" tabindex="3" value="<?=@$info['name'];?>" />
        </div>
        <div class="clear span-10">
            <label class="label-form float-left">Posici&oacute;n:&nbsp;&nbsp;&nbsp;</label>
            <select class="float-left" name="cboPosition">
                <option value="left">Izquierda</option>
                <option value="right" <?=@$info['position']=="right" ? 'selected="selected"' : '';?>>Derecha</option>
                <option value="top" <?=@$info['position']=="top" ? 'selected="selected"' : '';?>>Arriba</option>
                <option value="bottom" <?=@$info['position']=="bottom" ? 'selected="selected"' : '';?>>Abajo</option>
            </select>
        </div>
        <div class="clear span-10">
            <label class="label-form float-left">Visible:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <div class="float-left text-small">
                <span>Si</span><input type="radio" name="optVisible" <?=($info['visible']=='1' || !$info['visible']) ? 'checked="checked"' : '';?> value="1" tabindex="3" />&nbsp;&nbsp;&nbsp;
                <span>No</span><input type="radio" name="optVisible" <?=$info['visible']=='0' ? 'checked="checked"' : '';?> value="0" tabindex="3" />
            </div>
        </div>
        <div class="clear span-10">
            <label class="label-form float-left">*C&oacute;digo:</label><br />
            <textarea class="textarea-large validate" cols="22" rows="5" name="txtCode"><?=@$info['code'];?></textarea>
        </div>
        <!-- ======= END FORM ======= -->

        <div class="clear span-15 text-center prepend-top">
            <button type="button" class="button-large" onclick="Banner.save();">Guardar</button>
            <button type="button" class="button-large" onclick="location.href='<?=site_url('/paneladmin/banner/');?>'">Cancelar</button>
        </div>

        <input type="hidden" name="banner_id" value="<?=@$info['banner_id'];?>" />
    </form>
</div>

<script type="text/javascript">
<!--
    Banner.initializer(<?=!$info ? false : true;?>);
-->
</script>
