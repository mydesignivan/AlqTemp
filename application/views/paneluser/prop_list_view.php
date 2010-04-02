            <div class="float-right">
                <button type="button" class="button-small" onclick="location.href='<?=site_url('paneluser/propiedades/form/');?>';">Nuevo</button>
            <?php if( $listProp->num_rows>0 ){?>
                <button type="button" class="button-small" onclick="Prop.action.edit();">Modificar</button>
                <button type="button" class="button-small" onclick="Prop.action.del();">Eliminar</button>
            <?php }?>
            </div>

    <?php if( $listProp->num_rows>0 ){?>
            <table id="tblList" class="tbl-prop" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <td class="cell-1">&nbsp;</td>
                        <td class="cell-2">Im&aacute;gen</td>
                        <td class="cell-3">Ubicaci&oacute;n</td>
                        <td class="cell-4">Categor&iacute;a</td>
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
                        <td class="cell-2"><img src="<?=$row['image'];?>" alt="" width="85" height="70" /></td>
                        <td class="cell-3"><a href="<?=site_url('/paneluser/propiedades/form/'.$row['prop_id']);?>" class="link-title"><?=$row['address'];?></a></td>
                        <td class="cell-4"><?=$row["category"];?></td>
                    </tr>
            <?php }?>
                </tbody>
            </table>

    <?php }else{?>
        <br />
        <div class="notice text-center">No hay propiedades cargadas.</div>
    <?php }?>

