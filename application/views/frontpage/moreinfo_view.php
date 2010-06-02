<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="more-info">
    <div class="column-1">
        <?php $arrImages = $info['images']->result_array();?>
        <div class="photo-gallery">
            <div class="content-photo"><a id="thumb-preview" href="<?=$arrImages[0]['name'];?>" rel="group"><img src="<?=$arrImages[0]['name'];?>" alt="" width="316" height="233" /></a></div>
        </div>
        <div class="thumbs">
            <div class="col-arrow"><a href="javascript:void(ImageGallery.previous());"><img src="images/icon_arrow_left.png" alt="Left" onmouseover="this.src='images/icon_arrow_left_over.png'" onmouseout="this.src='images/icon_arrow_left.png'" width="22" height="22" /></a></div>
            <div class="col-middle" id="container-thumbs"></div>
            <div class="col-arrow"><a href="javascript:void(ImageGallery.next());"><img src="images/icon_arrow_right.png" alt="Right" onmouseover="this.src='images/icon_arrow_right_over.png'" onmouseout="this.src='images/icon_arrow_right.png'" width="22" height="22" /></a></div>
        </div>
    </div>
    <div class="column-2">
        <div class="slide">
            <img src="images/icon_contact2.png" alt="" class="icon-mail" width="44" height="37" />
            <form id="formConsult" action="" method="post" enctype="application/x-www-form-urlencoded">
                <div class="error"></div>
                <div class="success"></div>
                <div class="ajaxloader-mask"></div>
                <div class="ajaxloader"></div>
                <div class="span-6">
                    <label class="label-contact">*Nombre</label><br />
                    <input type="text" name="txtName" class="input-contact validate" />
                </div>
                <div class="clear span-6">
                    <label class="label-contact">*E-mail</label><br />
                    <input type="text" name="txtEmail" class="input-contact validate" />
                </div>
                <div class="clear span-6">
                    <label class="label-contact">N&uacute;mero de Contacto</label><br />
                    <input type="text" name="txtPhone" class="input-contact" />
                </div>
                <div class="clear span-6">
                    <label class="label-contact">*Consulta</label>
                    <textarea class="textarea-contact validate" name="txtConsult" cols="10" rows="3"></textarea>
                </div>
                <!-- ======= END FORM ======= -->

                <div class="clear span-6 text-center">
                    <button type="button" class="button-contact" onclick="MoreInfo.send_consult();">Enviar</button>
                </div>
            </form>
            <script type="text/javascript">
            <!--
                MoreInfo.initializer('<?=json_encode($arrImages);?>');
            -->
            </script>
        </div>
    </div>

    <div class="row-cont">
        <h2>Descripci&oacute;n</h2>
        <?=nl2br($info['description']);?>
    </div>

    <div class="row-cont bg-slide">
        <ul class="list-moreinfo">
            <li><img src="images/icon_address.png" alt="" width="19" height="15" /><?=$info['address'];?></li>
            <li><?php if( !empty($info['website']) ){?><img src="images/icon_web.png" alt="" width="19" height="15" /><a href="<?=$info['website'];?>" class="link5" target="_blank" rel="nofollow"><?=$info['website'];?></a><br /><?php }?></li>
            <li>
            <?php if( !empty($info['phone']) ){?>
                <img src="images/icon_phone.png" alt="" width="19" height="15" />
                <?php
                    if( !empty($info['phone_area']) ) echo $info['phone_area']." - ";
                    echo $info['phone']."<br />";
                 ?>
            <?php }?>
            </li>
            <?php if( !empty($info['price']) ){
                if( $info['pricemoney']=="$" ) $suffix = "peso";
                elseif( $info['pricemoney']=="U\$S" ) $suffix = "dolar";
                elseif( $info['pricemoney']=="€" ) $suffix = "euro";
             ?>
                <img src="images/icon_money_<?=$suffix;?>.png" alt="" width="16" height="16" />
                <?=$info['price']." ".$info['priceby'];?>
            <?php }?>
        </ul>
    </div>

<?php if( $cuentaplus ){?>

<?php if( $info['gmap_visible']==1 ) {?>
    <div class="row-cont">
        <h2>Ubicaci&oacute;n en el mapa</h2>
        <div id="map" class="gmap-moreinfo"></div>
    </div>
    <script type="text/javascript">
    <!--
        PGmap.initializer({
            coorLat   : <?=$info['gmap_lat'];?>,
            coorLng   : <?=$info['gmap_lng'];?>,
            zoom      : <?=$info['gmap_zoom'];?>,
            mapType   : '<?=$info['gmap_maptype'];?>',
            draggable : false
        });
    -->
    </script>
<?php }?>

<?php if( $info['movie_visible']==1 ) {?>
    <div class="row-cont">
        <h2>Video</h2>
        <?=sprintf(setup('CFG_MOVIE_OBJECT'), $info['movie_url'], $info['movie_url']);?>
    </div>
<?php }?>

<?php }?>

    <div class="row-cont">
        <h2>Servicios</h2>
        <ul class="ul-list">
        <?php
        $n=0;
        foreach( $info['services'] as $row ){
            $n++;
            //$class = $n%2 ? 'tbl-propuser' : 'tbl-propuser row-par';
        ?>
            <li><?=$row['name'];?></li>
        <?php }?>
        </ul>
    </div>

</div>
