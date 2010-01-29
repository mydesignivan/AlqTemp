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
| NOMBRE DE LAS TABLAS (BASE DE DATO)
|--------------------------------------------------------------------------
*/
define('TBL_IMAGES', 'images');
define('TBL_COUNTRY', 'list_country');
define('TBL_STATES', 'list_states');
define('TBL_SERVICES', 'list_services');
define('TBL_PROPERTIES', 'properties');
define('TBL_PROPERTIES_SERVS', 'properties_to_services');
define('TBL_USERS', 'users');
define('TBL_LOGSEARCHES', 'log_searches');


/*
|--------------------------------------------------------------------------
| MENSAJES DE ERROR
|--------------------------------------------------------------------------
*/
define('ERR_100', 'Se produjo un error interno en la base de dato.');
define('ERR_101', 'La actualizacion de los datos no pudo ser completado.');
define('ERR_102', 'Los datos no pudieron ser guardados.');
define('ERR_103', 'El usuario ha sido creado satisfactoriamente pero no se ha podido enviar el email de activaci&oacute;n del mismo');

define('ERR_UPLOAD_NOTUPLOAD', 'El archivo no ha podido llegar al servidor.');
define('ERR_UPLOAD_MAXSIZE', 'El tamaño del archivo debe ser menor a %s MB.');
define('ERR_UPLOAD_FILETYPE', 'El tipo de archivo es incompatible.');


/*
|--------------------------------------------------------------------------
| EMAIL FORM REGISTRO
|--------------------------------------------------------------------------
*/
define('EMAIL_REG_FROM', 'ivan@mydesign.com.ar');
define('EMAIL_REG_NAME', 'alquilerestemporarios.org');
define('EMAIL_REG_SUBJECT', 'Activación de Usuario');
define('EMAIL_REG_MESSAGE', '<a href="%s">Haga clic aqu&iacute; para activar su usuario</a>');

/*
|--------------------------------------------------------------------------
| EMAIL RECORDAR CONTRASEÑA
|--------------------------------------------------------------------------
*/
define('EMAIL_RP_FROM', 'ivan@mydesign.com.ar');
define('EMAIL_RP_NAME', 'alquilerestemporarios.org');
define('EMAIL_RP_SUBJECT', 'Recordatorio contraseña');
define('EMAIL_RP_MESSAGE', 'Su contrase&ntilde;a es %s');

/*
|--------------------------------------------------------------------------
| EMAIL FORMULARIO CONSULTA DE LA PROP
|--------------------------------------------------------------------------
*/
define('EMAIL_CONSULTPROP_SUBJECT', 'Consulta propiedad');
define('EMAIL_CONSULTPROP_MESSAGE', 'Propiedad: %s<br>Nombre persona: %s<br>Telefono: %s<br><hr color="#000000" />Consulta:<br>%s');

/*
|--------------------------------------------------------------------------
| EMAIL CONTACTO
|--------------------------------------------------------------------------
*/
define('EMAIL_CONTACT_TO', 'ivan@mydesign.com.ar');
define('EMAIL_CONTACT_SUBJECT', 'Formulario de consulta');
define('EMAIL_CONTACT_MESSAGE', 'Nombre: %s<br>Telefono: %s<br><hr color="#000000" />Consulta:<br>%s');

/*
|--------------------------------------------------------------------------
| UPLOAD FILE
|--------------------------------------------------------------------------
*/
define('UPLOAD_DIR', './uploads/');
define('UPLOAD_DIR_TMP', './uploads/tmp/');
define('UPLOAD_WIDTH', 107);
define('UPLOAD_HEIGHT', 90);
define('UPLOAD_FILETYPE', 'gif|jpg|png');
define('UPLOAD_MAXSIZE', 1024); //Expresado en Kylobytes

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */