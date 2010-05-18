<? 
if( $_SERVER['REQUEST_METHOD']=="POST" ){
	include("../../../includes/class.sendmail.php");
	$SendMail = new Class_SendMail();
	$SendMail->to = $_POST["to"];
	$SendMail->from = $_POST["email"];
	$SendMail->name_from = $_POST["name"];
	$SendMail->subject = "Desde www.getsouth.com: ".$_POST["subject"];
	$SendMail->message = $_POST["message"];
	if( $SendMail->send() )
		die("ok");
	else
		die("error");

}else{
?>

<div style='display:none'>
	<div class='contact-top'></div>
	<div class='contact-content'>
		<h1 class='contact-title'>Contact Form:</h1>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<form action='#' style='display:none'>
			<label for='contact-name'>*Name:</label>
			<input type='text' id='contact-name' class='contact-input' name='name' tabindex='1001' />
			<label for='contact-email'>*Email:</label>
			<input type='text' id='contact-email' class='contact-input' name='email' tabindex='1002' />
			<label for='contact-subject'>Subject:</label>
			<input type='text' id='contact-subject' class='contact-input' name='subject' value='' tabindex='1003' />
			<label for='contact-message'>*Message:</label>
			<textarea id='contact-message' class='contact-input' name='message' cols='40' rows='4' tabindex='1004'></textarea>
			<br/>
            
			<label>&nbsp;</label>
			<button type='submit' class='contact-send contact-button' tabindex='1006'>Send</button>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>Cancel</button>
			<br/>
			<input type="hidden" name="to" value="<? echo $_GET["emailto"];?>" />
		</form>
	</div>
	<div class='contact-bottom'></div>
</div>
<? }?>