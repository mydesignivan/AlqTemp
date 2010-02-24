<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_upload extends Controller {

    private $file;
    function __construct(){
        parent::Controller();
        $this->load->helper('form');
        $this->file = $_FILES[key($_FILES)];
        $this->load->library('image_lib');
    }


    /*
     * FUNCTIONS PUBLIC
     */
    public function index(){
        if( $this->validate() ){
            $filename = $this->get_filename();

            // Muevo la imagen original
            move_uploaded_file($this->file['tmp_name'], UPLOAD_DIR_TMP.$filename);

            // Creo una copia y dimensiono la imagen  (THUMB)
            $config['image_library'] = 'GD2';
            $config['source_image'] = UPLOAD_DIR_TMP.$filename;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = IMAGE_THUMB_WIDTH;
            $config['height'] = IMAGE_THUMB_HEIGHT;
            $this->image_lib->initialize($config);
            if( !$this->image_lib->resize() ) die($this->image_lib->display_errors());

            // Dimensiono la imagen original   (ORIGINAL)
            $config['image_library'] = 'GD2';
            $config['source_image'] = UPLOAD_DIR_TMP.$filename;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = IMAGE_ORIGINAL_WIDTH;
            $config['height'] = IMAGE_ORIGINAL_HEIGHT;
            $this->image_lib->initialize($config);
            if( !$this->image_lib->resize() ) die($this->image_lib->display_errors());

            $ext = substr($filename, (strripos($filename, ".")-strlen($filename))+1);
            $basename = substr($filename, 0, strripos($filename, "."));
            //echo "filename:".UPLOAD_DIR_TMP.$basename."_thumb.".$ext;

            echo json_encode(array(
                'thumb'=>UPLOAD_DIR_TMP.$basename."_thumb.".$ext,
                'complete'=>UPLOAD_DIR_TMP.$basename.".".$ext
            ));
        }
    }

    /*
     * FUNCTIONS PRIVATE
     */
    private function validate(){
        if( !is_uploaded_file($this->file['tmp_name']) ) show_error(ERR_UPLOAD_NOTUPLOAD);
        $size = (int)UPLOAD_MAXSIZE;
        if( round($this->file['size']/1024, 2) > (int)UPLOAD_MAXSIZE ) {
            die(sprintf(ERR_UPLOAD_MAXSIZE, (string)($size/1024)) );
        }
        if( !$this->is_allowed_filetype() ) show_error(ERR_UPLOAD_FILETYPE);

        return true;
    }

    private function is_allowed_filetype(){
        require_once(APPPATH.'config/mimes'.EXT);

        $extention = explode("|", UPLOAD_FILETYPE);
        foreach( $extention as $ext ){
            $mime = $mimes[$ext];

            if( is_array($mime) ){
                if( in_array($this->file['type'], $mime) ) return true;
            }else{
                if( $mime==$this->file['type'] ) return true;
            }
        }
        return false;
    }

    private function get_filename(){
        $name = preg_replace("/\s+/", "_", strtolower($this->file['name']));
        return $this->session->userdata('user_id') ."_". uniqid(time()) ."__". $name;
    }

}

?>