<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dataview{

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct($mydata=array()) {
        $this->CI =& get_instance();
        $this->_data = $mydata;
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $CI;
    private $_data;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function get_data($key=null){
        if( $key!=null ) 
            return $this->_data[$key];
        else 
            return $this->_data;
    }

    public function set_data($param1, $param2=null){
        if( is_string($param1) && is_string($param1) )
            $param1 = array($param1=>$param2);

        $data = $this->_data;
        
        foreach( $param1 as $key=>$val ){
            $data[$key] = $param1[$key];
        }
        return $data;
    }

}
?>
