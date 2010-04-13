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


            <button type="button" class="button-small" onclick="Orders.Search();">Buscar</button>
        </div>

        <?php if( $listOrders->num_rows>0 ){?>
            <button type="button" class="float-right button-small" onclick="Orders.action.Confirm();">Confirmar</button>
        <?php }?>

<?php if( $listOrders->num_rows>0 ){?>
        <table id="tblList" class="tbl-list" cellpadding="0" cellspacing="0">
            <thead>
                <tr class="tbl-orders">
                    <td class="cell-1">&nbsp;</td>
                    <td class="cell-2">Orden Nº</td>
                    <td class="cell-3">Usuario</td>
                    <td class="cell-4">Importe</td>
                    <td class="cell-5">Estado</td>
                    <td class="cell-6">Fecha Pedido</td>
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
                    <td class="cell-3"><a href="" class="link-title" target="_blank"><?=$row['username'];?></a></td>
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
