<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

        <div class="float-left">
            <span class="text-small">Buscar por</span>
            <select id="cboSearchBy" onchange="Banner.events.change_search(this.value)">
                <?php
                if( $this->uri->segment(3)=="search" && $this->uri->segment(4)!='' && $this->uri->segment(5)!='' ){
                    $search_key = $this->uri->segment(4);
                    $search_val = $this->uri->segment(5);
                }
                ?>
                <option value="name" <?=@$search_key=='name' ? 'selected="selected"' : '';?>>Nombre</option>
                <option value="position" <?=@$search_key=='position' ? 'selected="selected"' : '';?>>Posici&oacute;n</option>
                <option value="visible" <?=@$search_key=='visible' ? 'selected="selected"' : '';?>>Visible</option>
            </select>
            <input type="text" class="input-small" id="txtSearch" onkeypress="if( getKeyCode(event)==13 ) Banner.Search();" value="<?=@$search_val;?>" />
            <select id="cboPosition" class="hide">
                <option value="left">Izquierda</option>
                <option value="right" <?=@$search_val=='right' ? 'selected="selected"' : '';?>>Derecha</option>
                <option value="top" <?=@$search_val=='top' ? 'selected="selected"' : '';?>>Arriba</option>
                <option value="bottom" <?=@$search_val=='bottom' ? 'selected="selected"' : '';?>>Abajo</option>
            </select>
            <select id="cboVisible" class="hide">
                <option value="1">Visible</option>
                <option value="0" <?=@$search_val==0 ? 'selected="selected"' : '';?>>Oculto</option>
            </select>

            <button type="button" class="button-small" onclick="Banner.Search();">Buscar</button>
        </div>

        <?php if( $listBanner->num_rows>0 ){?>
            <button type="button" class="float-right button-small" onclick="Banner.action.del();">Eliminar</button>
            <button type="button" class="float-right button-small" onclick="Banner.action.edit();">Modificar</button>
        <?php }?>
            <button type="button" class="float-right button-small" onclick="location.href='<?=site_url('/paneladmin/banner/form/');?>';">Nuevo</button>

<?php if( $listBanner->num_rows>0 ){?>
        <?php require(APPPATH . 'views/includes/popup1_inc.php');?>
        <?php require(APPPATH . 'views/includes/popup2_inc.php');?>

        <table id="tblList" class="tbl-list" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="tbl-banner">
                    <td class="cell-1">&nbsp;</td>
                    <td class="cell-2">Nombre</td>
                    <td class="cell-3">Posici&oacute;n</td>
                    <td class="cell-4">Preview</td>
                    <td class="cell-5">Visible</td>
                </tr>
            </thead>
            <tbody>
        <?php
            $n=0;
            foreach( $listBanner->result_array() as $row ){
                $n++;
                $class = $n%2 ? 'tbl-banner' : 'tbl-banner row-par';
            ?>
                <tr id="tr<?=$n;?>" class="<?=$class;?> row-hover">
                    <td class="cell-1"><input type="checkbox" name="checkbox" value="<?=$row["banner_id"];?>" /></td>
                    <td class="cell-2"><a href="<?=site_url('/paneladmin/banner/form/'.$row['banner_id']);?>" class="link-title"><?=$row['name'];?></a></td>
                    <td class="cell-3"><?=$row['position'];?></td>
                    <td class="cell-4"><a href="javascript:void(Banner.open_popup(<?=$row['banner_id'];?>));" class="link1">Preview</a></td>
                    <td class="cell-5"><a href="javascript:void(0);" class="link1" onclick="Banner.change_visible(this, <?=$row['banner_id'];?>);"><?=$row['visible'];?></a><img src="images/ajax-loader.gif" alt="" class="hide" /></td>
                </tr>
        <?php }?>
            </tbody>
        </table>

        <div class="text-center"><?=$this->pagination->create_links();?></div>
                

<?php }else{?>

    <?php if( $this->uri->segment(4)!='' ){?>
        <br />
        <div class="notice text-center">No se han encontrado resultados.</div>
    <?php }else{?>
        <br />
        <div class="notice text-center">No hay banner cargados.</div>
    <?php }?>

<?php }?>

        <script type="text/javascript">
        <!--
            Banner.initializer();
        -->
        </script>
