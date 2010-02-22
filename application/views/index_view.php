<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Alquileres temporarios</title>
    <?php require('includes/head_inc.php');?>
    <script type="text/javascript" src="js/class.search.min.js"></script>
</head>

<body>
    <div id="container">
        <div id="header">
            <?php include ('includes/header_inc.php');?>
        </div>
        <!-- end #header -->

        
        <?php include('includes/banner_inc.php');?>
      
        <div class="container_mainContent">
            <div id="mainContent">
                <div class="content_top"><h1><?=$section_title;?></h1></div>
                <?php
                if( $listProp->num_rows==0 ){?>

                    <p>No se han encontrado resultados.</p>
                
                <?php }else{?>

                <?php foreach( $listProp->result_array() as $row ){?>
                <div class="description_properties">
                    <div class="image_properties"><img src="<?=$row['image_thumb'];?>" alt="" /></div>
                    <div class="description_text">
                        <?php $url=site_url('/masinfo/index/'.$row['prop_id']);?>

                        <h2><a class="link1" href="<?=$url;?>"><?=$row['address'];?></a></h2>
                        <p><?=character_limiter($row['description'], 150);?></p>
                        <b>Categor&iacute;a:</b> <?=$row['category'];?><br />
                        <b>Ciudad:</b> <?=$row['city'];?>
                        <?php if( !empty($row['price']) ){?><span><br />Precio: <?=$row['price'];?></span><?php }?>
                        <a class="info" href="<?=$url?>">M&aacute;s info</a>
                    </div>
                </div>
                <?php }
                
                    echo $this->pagination->create_links();

                }?>
            </div>
            <!-- end #mainContent -->
            <div class="background_bottom"></div>
      
            <br class="clearfloat" />
        
            <?php include ('includes/hitssearch_inc.php');?>
        </div>
        <!--end .container_mainContent-->
      
        <div id="footer">
            <?php include ('includes/footer_inc.php');?>
        </div><!-- end #footer -->

    </div>
    <!-- end #container -->
</body>
</html>
