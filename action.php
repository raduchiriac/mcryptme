<?php
require 'Mcrypt.php';
$source = new McryptResource();
$source->createResource(MCRYPT_RIJNDAEL_192, MCRYPT_MODE_CBC);

if($_POST['action'] == 'encrypt') {
	if(strlen($_POST['key']) == 0 || strlen($_POST['text']) == 0) {
		echo 'Not enought data...';
		return false;
	}
	$cipher = Mcrypt::encrypt($source, $_POST['key'], $_POST['text']);
	echo $cipher;
} elseif($_POST['action'] == 'decrypt') {
	if(strlen($_POST['key']) == 0 || strlen($_POST['text']) == 0) {
		echo 'Not enought data...';
		return false;
	}
	$decipher = Mcrypt::decrypt($source, $_POST['key'], $_POST['text']);
	echo $decipher;
}
?>