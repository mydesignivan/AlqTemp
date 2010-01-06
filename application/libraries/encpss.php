<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encpss{

    private $CI;
    function  __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('encrypt');
        $this->CI->encrypt->set_cipher(MCRYPT_BLOWFISH);
        $this->CI->encrypt->set_mode(MCRYPT_MODE_CFB);
    }

    public function encode($pss){
        if( empty($pss) ) return '';

        return $this->CI->encrypt->encode($pss);
    }

    public function decode($pss){
        return $this->CI->encrypt->decode($pss);
    }

}
?>
