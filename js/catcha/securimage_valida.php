<?
include 'securimage.php';
$image = new Securimage();

if ($image->check($_POST['code']) == true) {
	echo "ok";
} else {
	echo "error";
}
?>