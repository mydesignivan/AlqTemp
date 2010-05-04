<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="more-info">
    <div class="column-1">
        <?php $arrImages = $info['images']->result_array();?>
        <div class="photo-gallery">
            <div class="content-photo"><a id="thumb-preview" href="<?=$arrImages[0]['name'];?>" rel="group"><img src="<?=$arrImages[0]['name'];?>" alt="" width="316" height="233" /></a></div>
        </div>
        <div class="thumbs">
            <div class="col-arrow"><a href="javascript:void(ImageGallery.previous());"><img src="images/icon_arrow_left.png" alt="Left" onmouseover="this.src='images/icon_arrow_left_over.png'" onmouseout="this.src='images/icon_arrow_left.png'" /></a></div>
            <div class="col-middle" id="container-thumbs"></div>
            <div class="col-arrow"><a href="javascript:void(ImageGallery.next());"><img src="images/icon_arrow_right.png" alt="Right" onmouseover="this.src='images/icon_arrow_right_over.png'" onmouseout="this.src='images/icon_arrow_right.png'" /></a></div>
        </div>
    </div>
    <div class="column-2">
        <div class="slide">
            <img src="images/icon_contact2.png" alt="" class="icon-mail" />
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

    <div class="row-cont">
        <p>
            <img src="images/icon_address.png" alt="" /><?=$info['address'];?><br />
            <?php if( !empty($info['website']) ){?><img src="images/icon_web.png" alt="" /><a href="<?=$info['website'];?>" class="link5" target="_blank"><?=$info['website'];?></a><br /><?php }?>
            <?php if( !empty($info['phone']) ){?>
                <img src="images/icon_phone.png" alt="" />
                <?php
                    if( !empty($info['phone_area']) ) echo $info['phone_area']." - ";
                    echo $info['phone']."<br />";
                 ?>
            <?php }?>
            <!--<img src="images/icon_map.png" alt="" /><a href="#">Ver mapa</a>-->
        </p>
    </div>

<?php if( $cuentaplus && $info['gmap_visible']==1 ){?>
    <div class="row-cont">
        <div id="map" class="gmap"></div>
    </div>
    <script type="text/javascript">
    <!--
        PGmap.initializer();
        PGmap.Go({
            coorLat : <?=$info['gmap_lat'];?>,
            coorLng : <?=$info['gmap_lng'];?>,
            zoom    : <?=$info['gmap_zoom'];?>,
            mapType : '<?=$info['gmap_maptype'];?>'
        });
    -->
    </script>
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
