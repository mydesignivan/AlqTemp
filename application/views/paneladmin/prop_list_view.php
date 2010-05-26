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

            <button type="button" class="button-small" onclick="Prop.Search();">Buscar</button>
        </div>

        <?php if( $listProp->num_rows>0 ){?>
            <button type="button" class="float-right button-small" onclick="Prop.action.del();">Eliminar</button>
        <?php }?>

<?php if( $listProp->num_rows>0 ){?>
        <table id="tblList" class="tbl-list" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="tbl-propadmin">
                    <td class="cell-1">&nbsp;</td>
                    <td class="cell-2"><a href="<?=$orderby['address']['url'];?>" class="float-left">Ubicaci&oacute;n</a><?php if( $orderby['address']['order']!=null ){?><img src="images/<?=$orderby['address']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-3"><a href="<?=$orderby['username']['url'];?>" class="float-left">Usuario</a><?php if( $orderby['username']['order']!=null ){?><img src="images/<?=$orderby['username']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-4"><a href="<?=$orderby['date_added']['url'];?>" class="float-left">Fecha Creaci&oacute;n</a><?php if( $orderby['date_added']['order']!=null ){?><img src="images/<?=$orderby['date_added']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-5"><a href="<?=$orderby['last_modified']['url'];?>" class="float-left">Ultima Modificaci&oacute;n</a><?php if( $orderby['last_modified']['order']!=null ){?><img src="images/<?=$orderby['last_modified']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                </tr>
            </thead>
            <tbody>
        <?php
            $n=0;
            foreach( $listProp->result_array() as $row ){
                $n++;
                $class = $n%2 ? 'tbl-propadmin' : 'tbl-propadmin row-par';
            ?>
                <tr class="<?=$class;?>">
                    <td class="cell-1"><input type="checkbox" name="checkbox" value="<?=$row["prop_id"];?>" /></td>
                    <td class="cell-2"><a href="<?=site_url('/masinfo/index/'.$row['prop_id']);?>" class="link-title" target="_blank"><?=$row['address'];?></a></td>
                    <td class="cell-3"><?=$row['username'];?></td>
                    <td class="cell-4"><?=$row['date_added'];?></td>
                    <td class="cell-5"><?php if( $row['last_modified']!="00-00-0000 00:00:00" ) echo $row['last_modified'];?></td>
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
        <div class="notice text-center">No hay propiedades cargadas.</div>
    <?php }?>

<?php }?>

        <script type="text/javascript">
        <!--
            Prop.initializer();
        -->
        </script>
