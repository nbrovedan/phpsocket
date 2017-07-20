<?php

class Audio{

	private $message = array();
	private $numero_destino;
	private $url_audio;
	private $resposta_usuario;
	private $API;

	function __construct(){
		$this->API = new API();
	}

	public function getResponse(){
		return $this->response;
	}

	public function setResponse($response){
		$this->response = $response;
	}
	
	public function createMessage($numero_destino, $url_audio, $resposta_usuario){
		//Variáveis a compactar
		$key_list = array('numero_destino','url_audio','resposta_usuario');
		//Seta os valores
		$this->numero_destino = $numero_destino;
		$this->url_audio = $numero_destino;
		$this->resposta_usuario = $resposta_usuario;
		//Retorna um array
		return compact($key_list);
	}

	public function sendVoiceMessage($message){
		if(count($message) == 0){
			return false;
		}else{
			return $this->API->post('/audio', $message);
		}		
	}

	public function getVoiceMessage($id){
		return $this->API->get('/audio/' . $id);
	}

}

?>