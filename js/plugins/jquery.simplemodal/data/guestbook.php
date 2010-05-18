<? 
include("../../../connection/connection.php");

if( $_SERVER['REQUEST_METHOD']=="POST" ){
	session_start();

	include("../../../includes/functions.php");
	include("../../../js/catcha/securimage.php");
	
	
	$error = "error:0";
	define("UPLOAD_MAXSIZE", "5242880");
	
	$img = new Securimage();
	$valid = $img->check($_POST['code']);
	
	if( $valid ){
		if( isset($_FILES['fileUpload']['tmp_name']) ) {
			$ext = strtolower(substr($_FILES['fileUpload']['name'], strrpos($_FILES['fileUpload']['name'],".")+1));
			$path = "../../../container/visitorsbook";
			
		
			if( $ext=="jpg"||$ext=="gif" ) {
				if( $_FILES["fileUpload"]["size"] <= UPLOAD_MAXSIZE ){
					$code = save_guestbook();				
					$filename = $path."/".$code.".".$ext;
					
					if( copy($_FILES['fileUpload']['tmp_name'], $filename) ){
						$data->query("UPDATE panel_visitors_book SET photo='".$code.".".$ext."' WHERE codvbook=".$code);
					}else{
						$data->query("DELETE FROM panel_visitors_book WHERE codvbook=".$code);
						$error="error:3";
					}
				}else $error="error:2";
			}else $error="error:1";
		}else{
			save_guestbook();	
		}
	}else $error = "catcha error";
?>

<script type="text/javascript">
parent.contact.show_response_form("<? echo $error;?>");
</script>

<?

}else{
$country = $data->query("SELECT * FROM list_country ORDER BY name");
?>

<div style='display:none'>
	<div class='contact-top'></div>
	<div class='contact-content'>
		<h1 class='contact-title'>Visitor's Book:</h1>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<form name="form1" method="post" enctype="multipart/form-data" target="iframeUpload" action="js/simplemodal/data/guestbook.php" style='display:none'>
			<label for='contact-title'>*Subject:</label>
			<input type='text' id='contact-title' class='contact-input' name='title' value='' tabindex='1001' />            
			<label for='contact-name'>*Full name:</label>
			<input type='text' id='contact-name' class='contact-input' name='name' tabindex='1002' />
			<label for='contact-email'>*E-mail:</label>
			<input type='text' id='contact-email' class='contact-input' name='email' tabindex='1003' />
			<label for='contact-country'>Country:</label>
			<select name="country" tabindex="1004" class='contact-select'>
            <option value="">Select Country</option>
            <? while($row=mysql_fetch_array($country)){?>
            <option value="<? echo utf8_encode($row["name"]);?>"><? echo utf8_encode($row["name"]);?></option>
            <? }?>
            </select>
			<label for='contact-photo'>Attach picture (GIF/JPG):</label>
			<input type='file' class='contact-input' id="fileUpload" name="fileUpload" tabindex='1005' />            
			<label for='contact-comment'>*Comment:</label>
			<textarea id='contact-message' class='contact-input' name='comment' cols='40' rows='4' tabindex='1006'></textarea>
            
			<label for='contact-catcha'>*Enter code:</label>
            <div class="newrow">
	         <img src="js/catcha/securimage_show.php?sid=<? echo md5(uniqid(time()));?>" id="image" align="absmiddle" />
    	        <a href="#" onclick="document.getElementById('image').src = 'js/catcha/securimage_show.php?sid=' + Math.random(); return false">Show other</a><br />
                <input type="text" id="code" name="code" class="inputcatcha" tabindex="1006" />
            </div>
            
			<label>&nbsp;</label>
            
			<button type='submit' class='contact-send contact-button' tabindex='1006'>Send</button>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>Cancel</button>
			<br/>
			<iframe id="iframeUpload" name="iframeUpload" width="400" height="100" frameborder="1" style="display:none"></iframe>
		</form>
	</div>
	<div class='contact-bottom'></div>
</div>
<? }?>