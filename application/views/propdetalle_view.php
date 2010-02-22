<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>

    <!-- SCRIPT "ImageGallery" -->
    <link type="text/css" href="js/jquery.imagegallery/css/style.css" rel="stylesheet" />
    <script type="text/javascript" src="js/jquery.imagegallery/js/script.js"></script>
    <script type="text/javascript" src="js/jquery.imagegallery/js/execute.js"></script>
    <!-- END SCRIPT -->

    <!--SCRIPT "VALIDADOR DE FORMULARIOS"-->
    <link type="text/css" href="js/jquery.validator/css/style.css" rel="stylesheet"  />
    <script type="text/javascript" src="js/jquery.validator/js/script.js"></script>
    <!--END SCRIPT-->

    <script type="text/javascript" src="js/class.moreinfo.min.js"></script>
    <script type="text/javascript" src="js/class.search.min.js"></script>
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
                            <div class="arrow_left"><a href="javascript:void(ImageGallery.back());"><img src="images/arrow_photo_previous.png" alt="foto anterior" border="0" onmouseover="this.src='images/arrow_photo_previous_over.png'" onmouseout="this.src='images/arrow_photo_previous.png'" /></a></div>
                            <div class="middle">
                                <ul id="container-thumbs">
                            <?php                            
                            foreach( $arrImages as $row ){?>
                                    <li><a href="<?=$row['name'];?>"><img src="<?=$row['name_thumb'];?>" alt="" /></a></li>

                            <?php }?>
                                </ul>
                            </div>
                            <div class="arrow_right"><a href="javascript:void(ImageGallery.next());"><img src="images/arrow_photo_next.png" alt="foto anterior" border="0" onmouseover="this.src='images/arrow_photo_next_over.png'" onmouseout="this.src='images/arrow_photo_next.png'" /></a></div>
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
                        <form id="formConsult" action="" method="post" enctype="application/x-www-form-urlencoded">
                            <div class="message"></div>

                            <div class="row">
                                *Nombre <br />
                                <input type="text" name="txtName" class="validate" />
                            </div>

                            <div class="row">
                                *E-mail<br />
                                <input type="text" name="txtEmail" class="validate" />
                            </div>

                            <div class="row">
                                N&uacute;mero de Contacto<br />
                                <input type="text" name="txtPhone" />
                            </div>

                            <div class="row">
                                *Consulta<br />
                                <textarea class="consulta validate" name="txtConsult" cols="22" rows="4"></textarea>
                            </div>

                            <input type="button" class="send" value="Enviar" onclick="MoreInfo.send_consult();" />
                            <input type="hidden" name="id" value="<?=$this->uri->segment(3);?>" />
                        </form>

                        <script type="text/javascript">
                        <!--
                            MoreInfo.initializer();
                        -->
                        </script>
                    </div>

                    <div class="address">
                        <?php if( !empty($data['web_site']) ){?><p><img src="images/icon_web.png" alt="" border="0"/><?=$data['web_site'];?></p><?php }?>
                        <p><img src="images/icon_address.png" alt="" border="0"/><?=$data['address'];?></p>
                        <?php if( !empty($data['phone']) ){?><p><img src="images/icon_phone.png" alt="" border="0"/><?=$data['phone'];?></p><?php }?>
                        <!--<p><a class="link1" href="#"><img src="images/icon_map.png" alt="" border="0"/>Ver mapa</a></p>-->
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