<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php require(APPPATH . 'views/includes/popup2_inc.php');?>

<?php if( $this->session->userdata('fondo')>0 ){?>
            <div class="message-attention"><div class="message">El posicionamiento de la propiedad <b>se realizar&aacute; unicamente para la secci&oacute;n elegida</b> y la <b>propiedad seleccionada.</b> La duraci&oacute;n de la posici&oacute;n ser&aacute; de <b>1 mes</b> desde la fecha de contrataci&oacute;n.</div></div>

        <form id="form1" action="<?=site_url('paneluser/destacar/disting/');?>" method="post" enctype="application/x-www-form-urlencoded">

    <?php if( $listUndisting->num_rows>0 ){?>
                <div class="clear prepend-top">
                    <h2 class="float-left">Mis Propiedades</h2>
                    <button type="button" class="button-large float-right" onclick="Prop.action.disting();">Destacar</button>
                </div>
                <table class="tbl-list" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="tbl-propuser">
                            <td class="cell-1">&nbsp;</td>
                            <td class="cell-2">Im&aacute;gen</td>
                            <td class="cell-3">Ubicaci&oacute;n</td>
                            <td class="cell-4">Categor&iacute;a</td>
                        </tr>
                    </thead>
                    <tbody id="tbl-disting">
            <?php
                $n=0;
                foreach( $listUndisting->result_array() as $row ){
                    $n++;
                    $class = $n%2 ? 'tbl-propuser' : 'tbl-propuser row-par';
             ?>
                        <tr class="<?=$class;?>">
                            <td class="cell-1"><input type="checkbox" name="checkbox" value="<?=$row['prop_id'];?>" /></td>
                            <td class="cell-2"><img src="<?=$row['image'];?>" alt="" width="85" height="70" /></td>
                            <td class="cell-3"><a href="<?=site_url('/paneluser/propiedades/form/'.$row['prop_id']);?>" class="link-title"><?=$row["address"];?></a></td>
                            <td class="cell-4"><?=$row['category'];?></td>
                        </tr>
            <?php }?>
                    </tbody>
                </table>

    <?php }else{?>
            <br />
            <div class="notice text-center">No hay propiedades cargadas.</div>
    <?php }?>


    <?php if( $listDisting->num_rows>0 ){?>
                <div class="clear prepend-top">
                    <h2 class="float-left">Propiedades Destacadas</h2>
                    <button type="button" class="button-large float-right" onclick="Prop.action.undisting('#tbl-undisting');">No Destacar</button>
                </div>

                <table class="tbl-list" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="tbl-propuser">
                            <td class="cell-1">&nbsp;</td>
                            <td class="cell-2">Im&aacute;gen</td>
                            <td class="cell-3">Ubicaci&oacute;n</td>
                            <td class="cell-4">Destacado en</td>
                        </tr>
                    </thead>
                    <tbody id="tbl-undisting">
            <?php
                $n=0;
                foreach( $listDisting->result_array() as $row ){
                    $n++;
                    $class = $n%2 ? 'tbl-propuser' : 'tbl-propuser row-par';
             ?>
                        <tr class="<?=$class;?>">
                            <td class="cell-1"><input type="checkbox" name="checkbox" value="<?=$row['prop_id'];?>" /></td>
                            <td class="cell-2"><img src="<?=$row['image'];?>" alt="" width="85" height="70" /></td>
                            <td class="cell-3"><a href="<?=site_url('paneluser/propiedades/form/'.$row['prop_id']);?>" class="link-title"><?=$row["address"];?></a></td>
                            <td class="cell-4"><?=$row['type'];?></td>
                        </tr>
            <?php }?>
                    </tbody>
                </table>
    <?php }?>
            <input type="hidden" name="data_post" value="" />
        </form>
 <?php }else{?>

    <p>Usted no posee saldo para destacar una propiedad, para realizar esta operaci&oacute;n tiene que agregar fondos a su cuenta.</p>

<?php }?>
