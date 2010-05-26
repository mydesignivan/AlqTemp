<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orderby{

    /* CONSTRUCTOR
     **************************************************************************/
    function  __construct($param = array()) {
        $this->CI =& get_instance();
        $this->controller = $param['controller'];
        $this->icon_order_asc = $param['icon_order_asc'];
        $this->icon_order_desc = $param['icon_order_desc'];
        $this->arr_url = $param['arr_url'];
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $CI;
    private $controller;
    private $icon_order_asc;
    private $icon_order_desc;
    private $arr_url;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function get_url_orderby($name){
        $arr_url = $this->arr_url;

        $dir = isset($arr_url['order']) ? strtolower($arr_url['order']) : "asc";
        if( @$arr_url['orderby']==$name ) $dir = $dir=="asc" ? "desc" : "asc";

        unset($arr_url['orderby']);
        unset($arr_url['order']);
        unset($arr_url['page']);

        $url = array_implode("/", $arr_url);
        $cur = current($arr_url);
        if( count($arr_url)==1 && empty($cur) ) $url.="index/";

        $url = site_url($this->controller . "/" . $url . "orderby/$name/order/$dir");
        return $url;
    }

    public function get_order($name){
        $arr_url = $this->arr_url;
        $ret = null;
        if( @$arr_url['orderby']==$name ){
            $ret = @$arr_url['order']=="asc" ? $this->icon_order_asc : $this->icon_order_desc;
        }
        return $ret;
    }

    public function get_baseurl(){
        $arr_url = $this->arr_url;

        unset($arr_url['page']);
        $url = array_implode("/", $arr_url);
        $cur = current($arr_url);
        if( count($arr_url)==1 && empty($cur) ) $url.="index/";

        $url = site_url($this->controller . "/" . $url . "page/");
        return $url;
    }

}
?>
