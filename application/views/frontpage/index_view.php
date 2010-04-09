<?php if( $listProp->num_rows==0 ){?>

        <br /><br />
        <p class="text-center">No se han encontrado resultados.</p>

<?php }else{
        foreach( $listProp->result_array() as $row ){
            $url = site_url('/masinfo/index/'.$row['prop_id']);
?>

            <div class="prop-row">
                <div class="column-1"><a href="<?=$url;?>"><img src="<?=$row['image_thumb'];?>" alt="" /></a></div>
                <div class="column-2">
                    <h2><a href="<?=$url;?>" class="link4"><?=ucwords(strtolower($row['address']));?></a></h2>
                    <p><?=character_limiter(nl2br($row['description']), 150);?></p>
                    <label class="label-black">Categor&iacute;a:&nbsp;</label><span><?=$row['category'];?></span><br />
                    <label class="label-black">Ciudad:&nbsp;</label><span><?=$row['city'];?></span><br />
                    <?php if( !empty($row['price']) ){?><div class="float-left"><label class="label-black">Precio:&nbsp;</label><span><?=$row['price'];?></span></div><?php }?>
                </div>
                <div class="float-right">
                    <button type="button" class="button-small" onclick="location.href='<?=$url?>';">M&aacute;s info</button>
                </div>
            </div>

    <?php }
            echo '<div class="text-center">'.$this->pagination->create_links().'</div>';
}?>
