<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Captcha extends Controller {

    /* CONSTRUCTOR
     **************************************************************************/
    function __construct(){
        parent::Controller();
        $this->load->library('captcha/securimage');
    }

    /* PUBLIC FUNCTIONS
     **************************************************************************/
    public function index(){
        // Change some settings

        $this->securimage->image_width = 180;
        $this->securimage->image_height = 65;
        //$img->perturbation = 0.9; // 1.0 = high distortion, higher numbers = more distortion
        //$img->image_bg_color = new Securimage_Color("#0099CC");
        //$img->text_color = new Securimage_Color("#EAEAEA");
        //$img->text_transparency_percentage = 65; // 100 = completely transparent
        //$img->num_lines = 8;
        //$img->line_color = new Securimage_Color("#0000CC");
        //$img->signature_color = new Securimage_Color(rand(0, 64), rand(64, 128), rand(128, 255));
        //$img->image_type = SI_IMAGE_PNG;

        $this->securimage->show();
    }

    public function play(){
        $this->securimage->audio_format = (isset($_GET['format']) && in_array(strtolower($_GET['format']), array('mp3', 'wav')) ? strtolower($_GET['format']) : 'mp3');
        //$img->setAudioPath('/path/to/securimage/audio/');

        $this->securimage->outputAudioFile();
    }

}
?>