<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <!===== SCRIPT: ImageGallery =====-->
    <link type="text/css" href="js/jquery.imagegallery/css/style.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.imagegallery/js/script.js"></script>
    <script type="text/javascript">
    <!--
    var ImageGallery = new ClassImageGallery({
        selectorThumbs      : '#container-thumbs',
        selectorPreview     : '#thumb-preview',
        effect_slide        : true
    });
    -->
    </script>
    <!===== END SCRIPT =====-->

    <script type="text/javascript" src="js/class.moreinfo.js"></script>
    <script type="text/javascript" src="js/class.search.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
        <?php include ('includes/header_inc.php');?>
        </div><!-- end #header -->
      
        
        <?php include('includes/banner_inc.php');?>
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1>Detalle Propiedad</h1></div>
                <div class="content_left">
                    <div class="photos">
                        <?php $arrImages = $data['images']->result_array();?>
                        <div class="photo_top"><a href="#" id="thumb-preview"><img src="<?=$arrImages[0]['name'];?>" alt="" width="316" height="233" /></a></div>
                        <div class="photo_bottom">
                            <div class="arrow_left"><a href="#" onclick="ImageGallery.back(); return false;"><img src="images/arrow_photo_previous.png" alt="foto anterior" border="0" onmouseover="this.src='images/arrow_photo_previous_over.png'" onmouseout="this.src='images/arrow_photo_previous.png'" /></a></div>
                            <div class="middle">
                                <ul id="container-thumbs">
                            <?php                            
                            foreach( $arrImages as $row ){?>
                                    <li><a href="<?=$row['name'];?>"><img src="<?=$row['name_thumb'];?>" alt="" /></a></li>

                            <?php }?>
                                </ul>
                            </div>
                            <div class="arrow_right"><a href="#" onclick="ImageGallery.next(); return false;"><img src="images/arrow_photo_next.png" alt="foto anterior" border="0" onmouseover="this.src='images/arrow_photo_next_over.png'" onmouseout="this.src='images/arrow_photo_next.png'" /></a></div>
                        </div>
                    </div>
                    <!--end.photos-->

                    <div class="text">
                        <h2>Descripci&oacute;n</h2> 
                        <?=nl2br($data['description']);?>
                    </div>
                </div>
                <!--end .content_left-->

                <div class="content_right">
                    <div id="contFormConsult" class="contact">
                        <div class="mail_icon"></div>
                        <form name="formConsult" id="formConsult" action="" method="post" enctype="application/x-www-form-urlencoded">
                            <div class="message"></div>
                            *Nombre <br />
                            <div><input type="text" name="txtName" class="validate {v_required:true}" /></div>

                            <p>
                                *E-mail<br />
                                <div><input type="text" name="txtEmail" class="validate {v_required:true, v_email:true}" /></div>
                            </p>
                            <p>
                                N&uacute;mero de Contacto<br />
                                <input type="text" name="txtPhone" />
                            </p>
                            <p>
                                *Consulta<br />
                                <div><textarea class="consulta validate {v_required:true}" name="txtConsult" cols="22" rows="4"></textarea></div>
                            </p>
                            <input type="button" class="send" value="Enviar" onclick="MoreInfo.send_consult();" />
                            <input type="hidden" name="id" value="<?=$this->uri->segment(3);?>" />
                        </form>
                    </div>

                    <div class="address">
                        <?php if( !empty($data['web_site']) ){?><p><img src="images/icon_web.png" alt="" border="0"/><?=$data['web_site'];?></p><?php }?>
                        <p><img src="images/icon_address.png" alt="" border="0"/><?=$data['address'];?></p>
                        <?php if( !empty($data['phone']) ){?><p><img src="images/icon_phone.png" alt="" border="0"/><?=$data['phone'];?></p><?php }?>
                        <p><a class="link1" href="#"><img src="images/icon_map.png" alt="" border="0"/>Ver mapa</a></p>
                    </div>
                </div>
                <!--end.content_right-->
                <div class="services">
                    <h2>Servicios</h2>
                    <?php
                        $config['result'] = $data['services']->result_array();
                        $config['total_row'] = 3;
                        $config['field'] = "name";
                        $config['tag_open'] = '<div class="services_details">';
                        $config['tag_close'] = '</div>';
                        construct_bloq($config);
                    ?>
                </div>
                <!--end .services-->
            </div>
            <!--end .maintContent -->
            <div class="background_bottom"></div>
        </div>
        <!-- end .container_mainContent -->
      
    	<br class="clearfloat" />
      
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->
    </div>
    <!-- end #container -->
</body>
</html>