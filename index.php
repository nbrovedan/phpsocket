<?php
	require 'vendor/autoload.php';
	
	//Cria o objeto
	$audio = new Audio();
	//Cria a mensagem
	$message = $audio->createMessage('489998484701','https://www.google.com/audio.mp3',true);
	//Envia a mensagem
	print_r($audio->sendVoiceMessage($message));
	//Busca a mensagem 1
	print_r($audio->getVoiceMessage(1));
?>
