<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 class Captcha_model extends Model
 {
 	private $vals = array();
 	
	private $baseUrl;
	private $basePath = './';
	
	private $captchaImagePath = 'images/tmp/';
	private $captchaImageUrl  = 'images/tmp/';
	private $captchaFontPath  = './system/fonts/verdana.ttf';
	
	public function __construct($configVal = array()){
		parent::Model();

                $this->baseUrl = base_url();
		$this->load->plugin('captcha');
		
		if( !empty($config) )
                    $this->initialize($configVal);
		else
                    $this->vals = array(
                        'word'	 	=> '',
                        'word_length'	=> 6,
                        'img_path' 	=> $this->basePath . $this->captchaImagePath,
                        'img_url' 	=> $this->baseUrl . $this->captchaImageUrl,
                        'font_path'	=> $this->captchaFontPath,
                        'img_width'	=> '150',
                        'img_height' 	=> 50,
                        'expiration' 	=> 3600
                   );
	}	
	
	/**
	 * initializes the variables
	 *
	 * @author 	Mohammad Jahedur Rahman <jahed01@gmail.com>
	 * @access 	public
	 * @param 	array 	config
	 */		 	
	public function initialize ($configVal = array()){
            $this->vals = $configVal;
	} //end function initialize
	
	//---------------------------------------------------------------
	
	/**
	 * generate the captcha
	 *
	 * @author 	Mohammad Jahedur Rahman <jahed01@gmail.com>
	 * @access 	public
	 * @return 	array
	 */	
	public function generateCaptcha () {
            $cap = create_captcha($this->vals);
		
            return $cap;
	} //end function generateCaptcha	
 }
?>
