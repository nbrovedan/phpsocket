<?php

require_once 'api.class.php';

class Audio{

	private $numero_destino;
	private $url_audio;
	private $resposta_usuario;
	private $response;
	private $API;

	function __construct($numero_destino, $url_audio, $resposta_usuario){
		$this->API = new API();
		$this->numero_destino = $numero_destino;
		$this->url_audio = $url_audio;
		$this->resposta_usuario = $resposta_usuario;
	}

	public function getResponse(){
		return $this->response;
	}

	public function setResponse($response){
		$this->response = $response;
	}

	public function sendVoiceMessage(){
		$res = $this->API->post('/audio', array('numero_destino' => $this->numero_destino, 
		   					  			  'url_audio' => $this->url_audio,
								   		  'resposta_usuario' => $this->resposta_usuario));
		$this->setResponse($res->data());
	}

	public function getVoiceMessage($id){
		$res = $this->API->get('/audio/' . $id);
		$this->setResponse($res->data());
	}

}

?>