<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_upload extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        $this->load->helper('form');
        $this->load->library('image_lib');
        $this->_file = $_FILES[key($_FILES)];
    }

    /* PRIVATE PROPERTIES
     **************************************************************************/
    private $_file;

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        if( $this->_validate() ){
            $filename = $this->_get_filename();

            $ext = substr($filename, (strripos($filename, ".")-strlen($filename))+1);
            $basename = substr($filename, 0, strripos($filename, "."));

            // Muevo la imagen original
            move_uploaded_file($this->_file['tmp_name'], UPLOAD_DIR_TMP.$filename);

            $sizes = getimagesize(UPLOAD_DIR_TMP.$filename);

            // Crea una marca de agua en la imagen
            $config = array();
            $config['source_image'] = UPLOAD_DIR_TMP.$filename;
            $config['wm_type'] = 'overlay';
            $config['wm_overlay_path'] = UPLOAD_DIR_WATERMARK;
            $config['wm_vrt_alignment'] = 'bottom';
            $config['wm_hor_alignment'] = 'right';
            $config['wm_opacity'] = '30';
            $this->image_lib->initialize($config);
            if( $this->image_lib->watermark() ) {

                // Crea una copia y dimensiona la imagen  (THUMB)
                $config = array();
                $config['source_image'] = UPLOAD_DIR_TMP.$filename;
                $config['new_image'] = UPLOAD_DIR_TMP.$basename."_thumb.".$ext;
                $config['width'] = IMAGE_THUMB_WIDTH;
                $config['height'] = IMAGE_THUMB_HEIGHT;

                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                if( $this->image_lib->resize() ) {
                    // Dimensiona la imagen original   (ORIGINAL)

                    if( $sizes[0] > IMAGE_ORIGINAL_WIDTH || $sizes[1] > IMAGE_ORIGINAL_HEIGHT ){
                        $config = array();
                        $config['source_image'] = UPLOAD_DIR_TMP.$filename;
                        if( $sizes[0] > IMAGE_ORIGINAL_WIDTH ) $config['width'] = IMAGE_ORIGINAL_WIDTH;
                        if( $sizes[1] > IMAGE_ORIGINAL_HEIGHT ) $config['height'] = IMAGE_ORIGINAL_HEIGHT;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        if( $this->image_lib->resize() ) $this->_return($basename, $ext);
                        else die($this->image_lib->display_errors());

                    }else $this->_return($basename, $ext);

                }else die($this->image_lib->display_errors());

            }else die($this->image_lib->display_errors());

        }
    }

    /* PRIVATE FUNCTIONS
     **************************************************************************/
    private function _validate(){
        if( !is_uploaded_file($this->_file['tmp_name']) ) show_error(ERR_UPLOAD_NOTUPLOAD);
        $size = (int)UPLOAD_MAXSIZE;
        if( round($this->_file['size']/1024, 2) > (int)UPLOAD_MAXSIZE ) {
            die(sprintf(ERR_UPLOAD_MAXSIZE, (string)($size/1024)) );
        }
        if( !$this->_is_allowed_filetype() ) show_error(ERR_UPLOAD_FILETYPE);

        return true;
    }

    private function _is_allowed_filetype(){
        require_once(APPPATH.'config/mimes'.EXT);

        $extention = explode("|", UPLOAD_FILETYPE);
        foreach( $extention as $ext ){
            $mime = $mimes[$ext];

            if( is_array($mime) ){
                if( in_array($this->_file['type'], $mime) ) return true;
            }else{
                if( $mime==$this->_file['type'] ) return true;
            }
        }
        return false;
    }

    private function _get_filename(){
        $name = preg_replace("/\s+/", "_", strtolower($this->_file['name']));
        return $this->session->userdata('user_id') ."_". uniqid(time()) ."__". $name;
    }

    private function _return($basename, $ext){
        echo json_encode(array(
            'filename_thumb' =>  UPLOAD_DIR_TMP.$basename."_thumb.".$ext,
            'filename_full'  =>  UPLOAD_DIR_TMP.$basename.".".$ext
        ));
    }

}
?>