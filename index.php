<?php
	//error_reporting(E_ERROR | E_PARSE);
	
	require_once 'class/audio.class.php';

	require_once 'class/api.class.php';

	$API = new API();

	print_r($API->get('/state')->data());

	// $audio = new Audio('489998484701','https://www.google.com/audio.mp3',true);
	// $audio->sendVoiceMessage();
	// print_r($audio->getResponse());
	// $audio->getVoiceMessage(1);
?>
