<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="mainContent2">
    <div class="content_top"><h1>Destinos mas Buscados</h1></div>
    <div class="destinations">
        <?php 
            $config['result'] = $listSearches->result_array();
            $config['total_row'] = 4;
            $config['field'] = "search_term";
            $config['tag_open'] = '<div class="column line_right">';
            $config['tag_close'] = '</div>';
            $config['tag_open_special'] = '<div class="column">';
            $config['tag_link'] = true;
            construct_bloq($config);
        ?>

    </div>
</div>
<div class="background_bottom"></div>
