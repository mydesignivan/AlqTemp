<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="span-15 last">
<?php if( count($listDate)>0 ){?>
    <div class="float-left">
        <label class="label-form">Fecha:&nbsp;</label>
        <?=form_dropdown('cboDate', $listDate, (!$this->uri->segment(4)) ? date('Y-m-d') : $this->uri->segment(4), 'onchange="location.href=\''. str_replace(".html", "", site_url('paneladmin/log/display/')) .'/\'+this.value;" id="cboDate"');?>
    </div>
<?php }?>
<?php if( count($listLog)>0 ){?>
    <div class="float-right">
        <button type="button" onclick="Log.action.del();" class="button-large">Eliminar</button>
        <button type="button" onclick="Log.action.del_date();" class="button-large">Eliminar Fecha</button>
    </div>
<?php }?>
</div>

<?php if( count($listLog)>0 ){?>
    <table id="tblList" class="tbl-log" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <td class="cell-1">&nbsp;</td>
                <td class="cell-2">Fecha</td>
                <td class="cell-3">Mensaje</td>
            </tr>
        </thead>
        <tbody>
    <?php
        $n=0;
        foreach( $listLog as $row ){$n++;
        $class = $n%2 ? "" : 'row-par';
     ?>
            <tr class="<?=$class;?> row-hover">
                <td class="cell-1"><input type="checkbox" value="<?=$row['index'];?>" /></td>
                <td class="cell-2" onclick="checkRow(this)"><?=$row['date'];?></td>
                <td class="cell-3" onclick="checkRow(this)"><?=$row['message'];?></td>
            </tr>

    <?php }?>
        </tbody>
    </table>

    <div class="text-center">
    <?php echo $this->pagination->create_links();?>
    </div>

<?php }else{?>
    <br />
    <div class="notice text-center">No hay errores registrados.</div>
<?php }?>
