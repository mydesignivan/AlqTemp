<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title><?=setup('TITLE_GLOBAL') . @$tlp_title;?></title>
    <meta name="description" content="<?=setup('META_DESCRIPTION_GLOBALS') . @$tlp_meta_description;?>" />
    <meta name="keywords" content="<?=setup('META_KEYWORDS_GLOBALS') . @$tlp_meta_keywords;?>" />
    <meta name="robots" content="index,follow" />

    <?php require('includes/head_inc.php');?>
    <?php if( isset($tlp_script) && !empty($tlp_script) ) {
        if( !is_array($tlp_script) ) $tlp_script = array($tlp_script);
        foreach( $tlp_script as $file ){
            require('js/includes/'.$file.'_inc.php');
        }
    }?>
</head>

<body>
<div class="container">

    <div class="span-24 last">
        <!-- ================  HEADER  ================ -->
        <?php require('includes/header_inc.php');?>
        <!-- ================  END HEADER  ================ -->

        <!-- =============== CONTAINER CENTRAL =============== -->
        <div class="clear span-24 main-container">
            <div class="column-left">

                <div class="clear float-left">
                    <div class="row-top"><h1 class="title"><?=$tlp_title_section;?></h1></div>
                    <div class="row-center min-height-2">
                        <?php require($tlp_section);?>
                    </div>
                    <div class="row-bottom"></div>
                </div>

                <?php if( isset($tlp_form_hitssearch) ){?>
                <div class="clear float-left">
                    <div class="row-top"><h1 class="title">Destinos mas Buscados</h1></div>
                    <div class="row-center min-height-1">
                        <?php require('includes/hitssearch_inc.php');?>
                    </div>
                    <div class="row-bottom"></div>
                </div>
                <?php }?>

                <?php if( isset($tlp_form_similarsearcher) && $listSimSearches->num_rows>0 ){?>
                <div class="clear float-left">
                    <div class="row-top"><h1 class="title">Anuncios Similares</h1></div>
                    <div class="row-center min-height-1">
                        <?php require('includes/similarsearcher_inc.php');?>
                    </div>
                    <div class="row-bottom"></div>
                </div>
                <?php }?>
            </div>
            <!-- =============== BANNER VERTICAL =============== -->
            <?php require('includes/banner_vertical_inc.php');?>
            <!-- =============== END BANNER VERTICAL =============== -->
        </div>
        <!-- ================  END MAIN CONTAINER  ================ -->

        <!-- =============== FOOTER =============== -->
        <?php require('includes/footer_inc.php');?>
        <!-- =============== END FOOTER =============== -->
    </div>

</div>
</body>
</html>