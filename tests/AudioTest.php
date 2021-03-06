<?php

use PHPUnit_Framework_TestCase;

class AudioTest extends PHPUnit_Framework_TestCase{

	/**
     * @dataProvider dataValues
     */
	public function testSendVoiceMessage($numero_destino, $url_audio, $resposta_usuario, $expected){
		$audio = new Audio();
		$message = $audio->createMessage($numero_destino, $url_audio, $resposta_usuario);
		$this->assertEquals($expected, $audio->sendVoiceMessage($message));
	}

	public function dataValues()
    {
        return array(
          array('489998484701', 'http://www.google.com.br/audio.mp3', true, 200),
          array('489995617071', 'http://www.google.com.br/audio.mp3', true, 200),
          array('489912312221', 'http://www.google.com.br/audio.mp3', true, 200),
          array('489992212312', 'http://www.google.com.br/audio.mp3', false, 200)
        );
    }
}

?>