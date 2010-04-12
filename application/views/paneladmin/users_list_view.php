<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

        <div class="float-left">
            <span class="text-small">Buscar por</span>
            <select id="cboSearchBy" onchange="Account.events.change_search(this.value)">
                <?php
                if( $this->uri->segment(3)=="search" && $this->uri->segment(4)!='' && $this->uri->segment(5)!='' ){
                    $search_key = $this->uri->segment(4);
                    $search_val = $this->uri->segment(5);
                }
                ?>
                <option value="username" <?=@$search_key=='username' ? 'selected="selected"' : '';?>>Usuario</option>
                <option value="fondo" <?=@$search_key=='fondo' ? 'selected="selected"' : '';?>>Importe</option>
                <option value="active" <?=@$search_key=='active' ? 'selected="selected"' : '';?>>Estado</option>
                <option value="date_added" <?=@$search_key=='date_added' ? 'selected="selected"' : '';?>>Fecha Creaci&oacute;n</option>
                <option value="last_modified" <?=@$search_key=='last_modified' ? 'selected="selected"' : '';?>>Ultima Modificaci&oacute;n</option>
            </select>
            <input type="text" class="input-medium" id="txtSearch" onkeypress="if( getKeyCode(event)==13 ) Account.Search();" value="<?=@$search_val;?>" />
            <button type="button" class="button-small" onclick="Account.Search();">Buscar</button>
        </div>

        <?php if( $listUsers->num_rows>0 ){?>
            <button type="button" class="float-right button-small" onclick="Prop.action.del();">Eliminar</button>
        <?php }?>

<?php if( $listUsers->num_rows>0 ){?>
        <table id="tblList" class="tbl-users" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <td class="cell-1">&nbsp;</td>
                    <td class="cell-2">Usuario</td>
                    <td class="cell-3">Importe</td>
                    <td class="cell-4">Estado</td>
                    <td class="cell-5">Fecha Creaci&oacute;n</td>
                    <td class="cell-6">Ultima Modificaci&oacute;n</td>
                </tr>
            </thead>
            <tbody>
        <?php
            $n=0;
            foreach( $listUsers->result_array() as $row ){
                $n++;
                $class = $n%2 ? '' : 'class="row_par"';
            ?>
                <tr <?=$class;?>>
                    <td class="cell-1"><input type="checkbox" name="checkbox" value="<?=$row["user_id"];?>" /></td>
                    <td class="cell-2"><a href="" class="link-title" target="_blank"><?=$row['username'];?></a></td>
                    <td class="cell-3"><?=$row['fondo'];?></td>
                    <td class="cell-4"><a href="" class="link1"><?=$row['active']==1 ? "Activo" : "Inactivo";?></a></td>
                    <td class="cell-5"><?=$row['date_added'];?></td>
                    <td class="cell-6"><?php if( $row['last_modified']!="00-00-0000 00:00:00" ) echo $row['last_modified'];?></td>
                </tr>
        <?php }?>
            </tbody>
        </table>

        <div class="text-center"><?=$this->pagination->create_links();?></div>

        <script type="text/javascript">
        <!--
            //Prop.initializer();
        -->
        </script>

<?php }else{?>

    <?php if( $this->uri->segment(4)!='' ){?>
        <br />
        <div class="notice text-center">No se han encontrado resultados.</div>
    <?php }else{?>
        <br />
        <div class="notice text-center">No hay usuarios cargados.</div>
    <?php }?>

<?php }?>

