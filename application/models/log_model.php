<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class log_model extends Model {

    function  __construct() {
        parent::Model();
        $this->dir = 'application/logs/';
    }

    /*
     * PROPERTIES PRIVATE
     */
    private $dir;

    /*
     * FUNCTIONS PUBLIC
     */
    public function get_list($date, $offset=0, $limit=null){
        $rows = $this->get_rows($date);

        $new_rows = array();
        $last_row = count($rows)-1;

        if( $limit==null ) $limit = $last_row;
        else{
            $limit = $offset+$limit-1;
            if( $limit>$last_row ) $limit = $last_row;
        }

        for( $n=$offset; $n<=$limit; $n++ ){
            $row = $rows[$n];
            $new_rows[] = array(
                'index'   => $n,
                'date'    => substr($row, 8, 19),
                'message' => substr($row, 32, strlen($row)-32)
            );
        }

        return array(
            'result'=>$new_rows,
            'total_rows'=>$last_row+1
        );
    }

    public function delete($date, $arr_index){
        $rows = $this->get_rows($date);
        $f = fopen($this->dir."log-".$date.".php", "w");
        $out = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>\n\n";
        $n=0;

        foreach( $rows as $row ) {
            if( !in_array($n, $arr_index) ) $out .= $row;
            $n++;
        }
            
        fwrite($f, $out);
        fclose($f);

        return true;
    }

    public function delete_date($date){
        if( !unlink($this->dir."log-".$date.".php") ){
            return false;
        }
        return true;
    }



    /*
     * FUNCTION PRIVATE
     */
    private function get_rows($date){
        $d=opendir($this->dir);
        $ret = array();
        while( $file = readdir($d) ) {
            if( $file!="." AND $file!=".." ) {
                $filename_compare = "log-".$date.".php";
                if( $file==$filename_compare ) {
                    $rows = file($this->dir.$file);
                    unset($rows[0]);
                    unset($rows[1]);

                    $rows = array_values($rows);
                    $rows = array_reverse($rows);
                    
                    return $rows;
                }
            }
        }
        return array();
    }



}
?>