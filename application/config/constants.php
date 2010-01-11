<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 					'ab');
define('FOPEN_READ_WRITE_CREATE', 				'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 			'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| MENSAJES DE ERROR
|--------------------------------------------------------------------------
*/
define('ERR_100', 'Se produjo un error interno en la base de dato.');
define('ERR_101', 'La actualizacion de los datos no pudo ser completado.');
define('ERR_102', 'Los datos no pudieron ser guardados.');
define('ERR_103', 'El usuario ha sido creado satisfactoriamente pero no se ha podido enviar el email de activaci&oacute;n del mismo');

/*
|--------------------------------------------------------------------------
| EMAIL FORM REGISTRO
|--------------------------------------------------------------------------
*/
define('EMAIL_REG_FROM', 'ivan@mydesign.com.ar');
define('EMAIL_REG_NAME', 'alquilerestemporario.org');
define('EMAIL_REG_SUBJECT', 'alquilerestemporario.org - Activación de Usuario');
define('EMAIL_REG_MESSAGE', '<a href="">Haga click aquí para activar su usuario</a>');

/*
|--------------------------------------------------------------------------
| EMAIL RECORDAR CONTRASEÑA
|--------------------------------------------------------------------------
*/
define('EMAIL_RP_FROM', 'ivan@mydesign.com.ar');
define('EMAIL_RP_NAME', 'alquilerestemporario.org');
define('EMAIL_RP_SUBJECT', 'alquilerestemporario.org - Recordar contraseña');
define('EMAIL_RP_MESSAGE', 'Su contraseña es %s');


/* End of file constants.php */
/* Location: ./system/application/config/constants.php */