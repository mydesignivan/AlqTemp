<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <base href="<?=base_url();?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link href="css/style<?=$this->config->item('sufix_pack_css');?>.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
    <?php require('js/includes/googlemap_inc.php');?>
    <script type="text/javascript">
    <!--    
        $(document).ready(function(){
            PGmap.initializer({
                coorLat   : <?=str_replace("_", ".", $gmap['gmap_lat']);?>,
                coorLng   : <?=str_replace("_", ".", $gmap['gmap_lng']);?>,
                zoom      : <?=$gmap['gmap_zoom'];?>,
                mapType   : '<?=$gmap['gmap_maptype'];?>',
                draggable : false
            });
        })
    -->
    </script>
</head>

<body>
    <div id="map" class="gmap_zoom"></div>
</body>
</html>