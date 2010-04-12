<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

        <div class="float-left">
            <span class="text-small">Buscar por</span>
            <select id="cboSearchBy" onchange="Prop.events.change_search(this.value)">
                <?php
                if( $this->uri->segment(3)=="search" && $this->uri->segment(4)!='' && $this->uri->segment(5)!='' ){
                    $search_key = $this->uri->segment(4);
                    $search_val = $this->uri->segment(5);
                }
                ?>

                <option value="address" <?=@$search_key=='address' ? 'selected="selected"' : '';?>>Ubicaci&oacute;n</option>
                <option value="username" <?=@$search_key=='username' ? 'selected="selected"' : '';?>>Usuario</option>
                <option value="date_added" <?=@$search_key=='date_added' ? 'selected="selected"' : '';?>>Fecha Creaci&oacute;n</option>
                <option value="last_modified" <?=@$search_key=='last_modified' ? 'selected="selected"' : '';?>>Ultima Modificaci&oacute;n</option>
            </select>
            <input type="text" class="input-medium" id="txtSearch" onkeypress="if( getKeyCode(event)==13 ) Prop.Search();" value="<?=@$search_val;?>" />
            <button type="button" class="button-small" onclick="Prop.Search();">Buscar</button>
        </div>

        <?php if( $listProp->num_rows>0 ){?>
            <button type="button" class="float-right button-small" onclick="Prop.action.del();">Eliminar</button>
        <?php }?>

<?php if( $listProp->num_rows>0 ){?>
        <table id="tblList" class="tbl-prop" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <td class="cell-1">&nbsp;</td>
                    <td class="cell-5">Ubicaci&oacute;n</td>
                    <td class="cell-6">Usuario</td>
                    <td class="cell-7">Fecha Creaci&oacute;n</td>
                    <td class="cell-8">Ultima Modificaci&oacute;n</td>
                </tr>
            </thead>
            <tbody>
        <?php
            $n=0;
            foreach( $listProp->result_array() as $row ){
                $n++;
                $class = $n%2 ? '' : 'class="row_par"';
            ?>
                <tr <?=$class;?>>
                    <td class="cell-1"><input type="checkbox" name="checkbox" value="<?=$row["prop_id"];?>" /></td>
                    <td class="cell-5"><a href="<?=site_url('/masinfo/index/'.$row['prop_id']);?>" class="link-title" target="_blank"><?=$row['address'];?></a></td>
                    <td class="cell-6"><?=$row['username'];?></td>
                    <td class="cell-7"><?=$row['date_added'];?></td>
                    <td class="cell-8"><?php if( $row['last_modified']!="00-00-0000 00:00:00" ) echo $row['last_modified'];?></td>
                </tr>
        <?php }?>
            </tbody>
        </table>

        <div class="text-center"><?=$this->pagination->create_links();?></div>

        <script type="text/javascript">
        <!--
            Prop.initializer();
        -->
        </script>

<?php }else{?>
        
    <?php if( $this->uri->segment(4)!='' ){?>
        <br />
        <div class="notice text-center">No se han encontrado resultados.</div>
    <?php }else{?>
        <br />
        <div class="notice text-center">No hay propiedades cargadas.</div>
    <?php }?>

<?php }?>

