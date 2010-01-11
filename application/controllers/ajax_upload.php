<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_upload extends Controller {

    function __construct(){
        parent::Controller();
    }

    public function index(){
        print_r($_FILES);
    }


}

?>