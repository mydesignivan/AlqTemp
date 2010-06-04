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

        <br class="clear" /><br class="clear" /><br class="clear" />

        <h2>Descripci&oacute;n</h2>
        <?=nl2br($info['description']);?>

        <div class="bg-slide prepend-top">
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
                    /*if( $info['pricemoney']=="$" ) $suffix = "peso";
                    elseif( $info['pricemoney']=="U\$S" ) $suffix = "dolar";
                    elseif( $info['pricemoney']=="€" ) $suffix = "euro";
                    echo '<img src="images/icon_money_'.$suffix.'.png" alt="" width="16" height="16" />';*/
                 ?>
                    <?='&nbsp;<b>'.$info['pricemoney']."</b> ".$info['price']." ".$info['priceby'];?>
                <?php }?>
            </ul>
        </div>
    </div><!-- end column-1 -->

    <div class="column-2">
        <div class="slide">
            <img src="images/icon_contact2.png" alt="" class="icon-mail" width="44" height="37" />
            <form id="formConsult" action="" method="post" enctype="application/x-www-form-urlencoded">
                <div class="error"></div>
                <div class="success"></div>
                <div class="ajaxloader-mask"></div>
                <div class="ajaxloader"></div>
                <div class="span-6">
                    <input type="text" name="txtName" class="input-contact validate" value="Nombre" title="Nombre" onfocus="clear_input(event)" onblur="set_input(event,'Nombre')" />
                </div>
                <div class="clear span-6">
                    <input type="text" name="txtEmail" class="input-contact validate" value="E-mail" title="E-mail" onfocus="clear_input(event)" onblur="set_input(event,'E-mail')" />
                </div>
                <div class="clear span-6">
                    <input type="text" name="txtPhone" class="input-contact" value="N&uacute;mero de Contacto" title="N&uacute;mero de Contacto" onfocus="clear_input(event)" onblur="set_input(event,'N&uacute;mero de Contacto')" />
                </div>

                <div class="clear span-6">
                    <div class="span-1"><label class="label-contact">Llegada</label></div>
                    <div class="span-4 float-right">
                        <input type="text" name="txtResLlegada" class="input-date1 datepicker" />
                    </div>
                </div>
                <div class="clear span-6">
                    <div class="span-1"><label class="label-contact">Salida</label></div>
                    <div class="span-4 float-right">
                        <input type="text" name="txtResSalida" class="input-date1 datepicker" />
                    </div>
                </div>
                <div class="clear span-6">
                    <label class="label-contact">Adultos</label>
                    <select name="cboResAdultos">
                        <?php for( $n=0; $n<=9; $n++ ) {
                            if( $n==0 ) echo '<option value="null">'.$n.'</option>';
                            else echo '<option value="'.$n.'">'.$n.'</option>';
                        }?>
                    </select>
                    <label class="label-contact">Ni&ntilde;os</label>
                    <select name="cboResNinios">
                        <?php for( $n=0; $n<=9; $n++ ) {
                            if( $n==0 ) echo '<option value="null">'.$n.'</option>';
                            else echo '<option value="'.$n.'">'.$n.'</option>';
                        }?>
                    </select>
                </div>

                <div class="clear span-6 prepend-top-small">
                    <textarea class="textarea-contact validate" name="txtConsult" cols="10" rows="3" title="Consulta" onfocus="clear_input(event)" onblur="set_input(event,'Consulta')">Consulta</textarea>
                </div>
                <!-- ======= END FORM ======= -->

                <div class="clear span-6 text-center">
                    <button type="button" class="button-contact" onclick="MoreInfo.send_consult();">Enviar</button>
                </div>

                <input type="hidden" name="address" value="<?=$info['address'];?>" />
            </form>
            <script type="text/javascript">
            <!--
                MoreInfo.initializer('<?=json_encode($arrImages);?>');
            -->
            </script>
        </div>

    <?php if( $info['gmap_visible']==1 ) {?>
            <div class="gmap-moreinfo">
                <h2>Ubicaci&oacute;n en el mapa</h2>
                <div id="map" class="gmap-info"></div>
                <script type="text/javascript">
                <!--
                    PGmap.initializer({
                        coorLat   : <?=$info['gmap_lat'];?>,
                        coorLng   : <?=$info['gmap_lng'];?>,
                        zoom      : <?=$info['gmap_zoom'];?>,
                        mapType   : '<?=$info['gmap_maptype'];?>',
                        draggable : false,
                        controlLargeMap : false,
                        controlMapType  : false,
                        iconMarker : 'images/home2.png',
                        iconMap    : [0,0, 50,0, 50,50, 0,50],
                        iconSizeX  : 50,
                        iconSizeY  : 50
                    });
                -->
                </script>
                <a href="javascript:void(MoreInfo.gmap_zoom())" class="link5">Ampliar mapa</a>
            </div>
    <?php }?>

    <?php if( $cuentaplus ){?>

        <?php if( $info['movie_visible']==1 ) {?>
            <div class="row-cont">
                <h2>Video</h2>
                <?=sprintf(setup('CFG_MOVIE_OBJECT'), $info['movie_url'], $info['movie_url']);?>
            </div>
        <?php }?>

    <?php }?>
    </div><!-- end column-2 -->
    
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

<?php require(APPPATH . 'views/includes/popup2_inc.php');?>
