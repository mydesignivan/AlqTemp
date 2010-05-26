<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

        <div class="float-left">
            <span class="text-small">Buscar por</span>
            <select id="cboSearchBy" onchange="Orders.events.change_search(this.value)">
                <?php
                if( $this->uri->segment(3)=="search" && $this->uri->segment(4)!='' && $this->uri->segment(5)!='' ){
                    $search_key = $this->uri->segment(4);
                    $search_val = $this->uri->segment(5);
                }
                ?>
                <option value="username" <?=@$search_key=='username' ? 'selected="selected"' : '';?>>Usuario</option>
                <option value="importe" <?=@$search_key=='importe' ? 'selected="selected"' : '';?>>Importe</option>
                <option value="status" <?=@$search_key=='status' ? 'selected="selected"' : '';?>>Estado</option>
                <option value="date" <?=@$search_key=='date' ? 'selected="selected"' : '';?>>Fecha Pedido</option>
            </select>
            <input type="text" class="input-medium" id="txtSearch" onkeypress="if( getKeyCode(event)==13 ) Orders.Search();" value="<?=@$search_val;?>" />
            <select id="cboStatus" class="hide">
                <option value="1">Pendiente</option>
                <option value="2" <?=@$search_val==2 ? 'selected="selected"' : '';?>>Confirmado</option>
            </select>

            <?php
                $selected1="";
                $selected2="";
                $selected3="";
                if( @$search_key=="date" ) {
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

            <button type="button" class="button-small" onclick="Orders.Search();">Buscar</button>
        </div>

        <?php if( $listOrders->num_rows>0 ){?>
            <button type="button" class="float-right button-small" onclick="Orders.action.Confirm();">Confirmar</button>
        <?php }?>

<?php if( $listOrders->num_rows>0 ){?>
        <?php require(APPPATH . 'views/includes/popup2_inc.php');?>
            
        <table id="tblList" class="tbl-list" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="tbl-orders">
                    <td class="cell-1">&nbsp;</td>
                    <td class="cell-2"><a href="<?=$orderby['order_id']['url'];?>" class="float-left">Nº</a><?php if( $orderby['order_id']['order']!=null ){?><img src="images/<?=$orderby['order_id']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-3"><a href="<?=$orderby['username']['url'];?>" class="float-left">Usuario</a><?php if( $orderby['username']['order']!=null ){?><img src="images/<?=$orderby['username']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-4"><a href="<?=$orderby['importe']['url'];?>" class="float-left">Importe</a><?php if( $orderby['importe']['order']!=null ){?><img src="images/<?=$orderby['importe']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-5"><a href="<?=$orderby['status']['url'];?>" class="float-left">Estado</a><?php if( $orderby['status']['order']!=null ){?><img src="images/<?=$orderby['status']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                    <td class="cell-6"><a href="<?=$orderby['date']['url'];?>" class="float-left">Fecha Pedido</a><?php if( $orderby['date']['order']!=null ){?><img src="images/<?=$orderby['date']['order'];?>" alt="" width="16" height="16" class="float-right" /><?php }?></td>
                </tr>
            </thead>
            <tbody>
        <?php
            $n=0;
            foreach( $listOrders->result_array() as $row ){
                $n++;
                $class = $n%2 ? 'tbl-orders' : 'tbl-orders row-par';
            ?>
                <tr class="<?=$class;?>">
                    <td class="cell-1"><input type="checkbox" name="checkbox" value="<?=$row["order_id"];?>" /></td>
                    <td class="cell-2"><?=$row['order_id'];?></td>
                    <td class="cell-3"><a href="javascript:void(Orders.open_popup(<?=$row['user_id'];?>))" class="link-title"><?=$row['username'];?></a></td>
                    <td class="cell-4"><?=$row['importe'];?></td>
                    <td class="cell-5"><?=$row['status'];?></td>
                    <td class="cell-6"><?=$row['date'];?></td>
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
        <div class="notice text-center">No hay pedidos realizados.</div>
    <?php }?>

<?php }?>

        <script type="text/javascript">
        <!--
            Orders.initializer();
        -->
        </script>
