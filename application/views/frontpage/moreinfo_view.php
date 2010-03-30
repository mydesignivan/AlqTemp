            <div class="more-info">
                <div class="column-1">
                    <div class="photo-gallery">
                        <?php $arrImages = $info['images']->result_array();?>
                        <div class="content-photo"><a id="thumb-preview" href="#" id="thumb-preview"><img src="<?=$arrImages[0]['name'];?>" alt="" width="316" height="233" /></a></div>
                    </div>
                    <div class="thumbs">
                        <div class="col-arrow"><a href="javascript:void(ImageGallery.back());"><img src="images/icon_arrow_left.png" alt="Left" onmouseover="this.src='images/icon_arrow_left_over.png'" onmouseout="this.src='images/icon_arrow_left.png'" /></a></div>
                        <div class="col-middle">
                            <ul id="container-thumbs">
                            <?php
                            foreach( $arrImages as $row ){?>
                                <li><a href="<?=$row['name'];?>"><img src="<?=$row['name_thumb'];?>" alt="" /></a></li>
                            <?php }?>
                            </ul>
                        </div>
                        <div class="col-arrow"><a href="javascript:void(ImageGallery.next());"><img src="images/icon_arrow_right.png" alt="Right" onmouseover="this.src='images/icon_arrow_right_over.png'" onmouseout="this.src='images/icon_arrow_right.png'" /></a></div>
                    </div>
                    <div class="description prepend-left-small">
                        <h2>Descripci&oacute;n</h2>
                        <?=nl2br($info['description']);?>
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
                            <p>
                                <label class="label2">*Nombre</label><br />
                                <input type="text" name="txtName" class="input-contact validate" />
                            </p>
                            <p>
                                <label class="label2">*E-mail</label><br />
                                <input type="text" name="txtEmail" class="input-contact validate" />
                            </p>
                            <p>
                                <label class="label2">N&uacute;mero de Contacto</label><br />
                                <input type="text" name="txtPhone" class="input-contact" />
                            </p>
                            <p>
                                <label class="label2">*Consulta</label>
                                <textarea class="textarea-contact validate" name="txtConsult" cols="10" rows="3"></textarea>
                            </p>
                            <p class="text-center">
                                <button type="button" class="button-contact" onclick="MoreInfo.send_consult();">Enviar</button>
                            </p>
                        </form>
                        <script type="text/javascript">
                        <!--
                            MoreInfo.initializer();
                        -->
                        </script>
                    </div>

                    <div class="slide prepend-top">
                        <img src="images/icon_contact2.png" alt="" class="icon-mail" />
                        <?php if( !empty($info['website']) ){?><p><img src="images/icon_web.png" alt="" /><a href="<?=$info['website'];?>"><?=$info['website'];?></a></p><?php }?>
                        <p><img src="images/icon_address.png" alt="" /><span class="text-small"><?=$info['address'];?></span></p>
                        <?php if( !empty($info['phone']) ){?><p><img src="images/icon_phone.png" alt="" /><span class="text-small"><?=$info['phone'];?></span></p><?php }?>
                        <!--<p><img src="images/icon_map.png" alt="" /><a href="#">Ver mapa</a></p>-->
                    </div>
                </div>
            </div>

            <div class="more-info-servicios prepend-left-small">
                <h2>Servicios</h2>
                <?php
                    $config['result'] = $info['services'];
                    $config['total_row'] = 3;
                    $config['field'] = "name";
                    $config['tag_open'] = '<ul class="ul-list line-right">';
                    $config['tag_close'] = '</ul>';
                    $config['tag_open_special'] = '<ul class="ul-list">';
                    construct_bloq($config);
                ?>
            </div>
