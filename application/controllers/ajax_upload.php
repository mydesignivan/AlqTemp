<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_upload extends Controller {

    function __construct(){
        parent::Controller();
        $this->load->helper('form');
    }

    public function index(){
        //$config['upload_path'] = UPLOAD_DIR_TMP;
        $config['upload_path'] = "./uploads/";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = UPLOAD_WIDTH;
        $config['max_height'] = UPLOAD_HEIGHT;
        $this->load->library('upload', $config);

        if( !$this->upload->do_upload() ){
            echo $this->upload->display_errors();
        }else{
            echo $this->upload->data();
        }


        die();
        if( $_SERVER['REQUEST_METHOD']=="POST" ){
            $file = $_FILES[key($_FILES)];

            if( is_uploaded_file($file['tmp_name']) ) {
                if( $type=='image/jpeg'||$type=='image/pjpeg'||$type=='image/gif'||$type=='image/png'||$type=='image/x-png' ) {
                    $filename = $this->session->userdata('user_id') ."_". uniqid(time()) ."__". strtolower($file['name']);

                    move_uploaded_file($file['tmp_name'], UPLOAD_DIR_TMP.$filename);

                    $config['image_library'] = 'GD';
                    $config['source_image'] = UPLOAD_DIR_TMP.$filename;
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = UPLOAD_WIDTH;
                    $config['height'] = UPLOAD_HEIGHT;
                    $this->load->library('image_lib', $config);

                    if( ! $this->image_lib->resize() ){
                        echo $this->image_lib->display_errors();
                    }else{
                        /*$ext = substr($filename, (strripos($filename, ".")-strlen($filename))+1);
                        $basename = substr($filename, 0, strripos($filename, "."));*/
                        echo "filename:".$filename;
                    }
                }else{
                    
                }

            }else{

            }
        }        
    }


}

?>