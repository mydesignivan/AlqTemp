<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<ul class="ul-list">
<?php
$n=0;
foreach( $listSearches->result_array() as $row ){
    $n++;
    //$class = $n%2 ? 'tbl-propuser' : 'tbl-propuser row-par';
?>
    <li><a href="<?=site_url('searcher/city/'.$row['search_term']);?>" class="link1"><?=$row['search_term'];?></a></li>
<?php }?>
</ul>
