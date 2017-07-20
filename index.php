<?php
	//error_reporting(E_ERROR | E_PARSE);
	
	require 'vendor/autoload.php';
		
	$audio = new Audio();
	$message = $audio->createMessage('489998484701','https://www.google.com/audio.mp3',true);
	print_r($audio->sendVoiceMessage($message)->data());
?>
