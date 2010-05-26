<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

        <div class="float-left">
            <span class="text-small">Buscar por</span>
            <select id="cboSearchBy" onchange="Users.events.change_search(this.value)">
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
            <input type="text" class="input-medium" id="txtSearch" onkeypress="if( getKeyCode(event)==13 ) Users.Search();" value="<?=@$search_val;?>" />

            <select id="cboStatus" class="hide">
                <option value="1">Activo</option>
                <option value="0" <?=@$search_val=='0' ? 'selected="selected"' : '';?>>Inactivo</option>
            </select>

            <?php
                $selected1="";
                $selected2="";
                $selected3="";
                if( @$search_key=="date_added" || @$search_key=="last_modified" ) {
                    $d = explode("-", $search_val);
                    $selected1 = $d[0];
                    $selected2 = $d[1];
                    $selected3 = $d[2];
                }
            ?>
            <select id="cboDateDay" class="hide jq-date">
                <option value="any">any</option>
            <?php for( $n=1; $n<=31; $n++ ){$num = ($n<10) ? "0".$n : $n;?>
                <option value="<?=$num;?>" <?php if( $selected1==$n ) echo 'selected="selected"';?>><?=$num;?></option>
            <?php }?>
            </select>
            <select id="cboDateMonth" class="hide jq-date">
                <option value="any">any</option>
            <?php for( $n=1; $n<=12; $n++ ){$num = ($n<10) ? "0".$n : $n;?>
                <option value="<?=$num;?>" <?php if( $selected2==$n ) echo 'selected="selected"';?>><?=$num;?></option>
            <?php }?>
            </select>
            <select id="cboDateYear" class="hide jq-date">
                <option value="any">any</option>
            <?php for( $n=date('Y')-10; $n<=date('Y'); $n++ ){?>
                <option value="<?=$n;?>" <?php if( $selected3==$n ) echo 'selected="selected"';?>><?=$n;?></option>
            <?php }?>
            </select>

            <button type="button" class="float-right button-small" onclick="Users.Search();">Buscar</button>
        </div>

        <?php if( $listUsers->num_rows>0 ){?>
            <button type="button" class="float-right button-small" onclick="Users.action.del();">Eliminar</button>
        <?php }?>

<?php if( $listUsers->num_rows>0 ){?>
        <?php require(APPPATH . 'views/includes/popup1_inc.php');?>
        <?php require(APPPATH . 'views/includes/popup2_inc.php');?>

        <table id="tblList" class="tbl-list" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="tbl-users">
                    <td class="cell-1">&nbsp;</td>
                    <td class="cell-2"><a href="<?=$orderby['username']['url'];?>" class="float-left">Usuario</a><?php if( $orderby['username']['order']!=null ){?><img src="images/<?=$orderby['username']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-3"><a href="<?=$orderby['online']['url'];?>">Online</a><?php if( $orderby['online']['order']!=null ){?><img src="images/<?=$orderby['online']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-4"><a href="<?=$orderby['status']['url'];?>">Estado</a><?php if( $orderby['status']['order']!=null ){?><img src="images/<?=$orderby['status']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-5"><a href="<?=$orderby['date_added']['url'];?>">Fecha Creaci&oacute;n</a><?php if( $orderby['date_added']['order']!=null ){?><img src="images/<?=$orderby['date_added']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-6"><a href="<?=$orderby['last_modified']['url'];?>">Ultima Modificaci&oacute;n</a><?php if( $orderby['last_modified']['order']!=null ){?><img src="images/<?=$orderby['last_modified']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                </tr>
            </thead>
            <tbody>
        <?php
            $n=0;
            foreach( $listUsers->result_array() as $row ){
                $n++;
                $class = $n%2 ? 'tbl-users' : 'tbl-users row-par';
            ?>
                <tr class="<?=$class;?>">
                    <td class="cell-1"><input type="checkbox" name="checkbox" value="<?=$row["user_id"];?>" /></td>
                    <td class="cell-2"><a href="javascript:void(Users.open_popup(<?=$row["user_id"];?>));" class="link-title"><?=$row['username'];?></a></td>
                    <td class="cell-3"><img src="images/<?=$row['online']==0 ? "icon_status_offline.png" : "icon_status_online.png";?>" alt="<?=$row['online']==0 ? "Offline" : "Online";?>" width="16" height="16" /></td>
                    <td class="cell-4"><a href="javascript:void(0)" class="link1" onclick="Users.change_status(this, <?=$row["user_id"];?>)"><?=$row['active']==1 ? "Activo" : "Inactivo";?></a><img src="images/ajax-loader.gif" alt="" class="hide" width="16" height="16" /></td>
                    <td class="cell-5"><?=$row['date_added'];?></td>
                    <td class="cell-6"><?php if( $row['last_modified']!="00-00-0000 00:00:00" ) echo $row['last_modified'];?></td>
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
        <div class="notice text-center">No hay usuarios cargados.</div>
    <?php }?>

<?php }?>

        <script type="text/javascript">
        <!--
            Users.initializer();
        -->
        </script>
