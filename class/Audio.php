<?php

class Audio{

	private $numero_destino;
	private $url_audio;
	private $resposta_usuario;
	private $API;
	//Cria a API
	function __construct(){
		$this->API = new API();
	}
	//Cria um array de mensagem para enviar ao POST
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
	//Envia uma mensagem de voz - retorna o statusCode
	public function sendVoiceMessage($message){
		if(count($message) == 0){
			return false;
		}else{
			return $this->API->post('/audio', $message)->getStatusCode();
		}		
	}
	//Obter uma mensagem de voz de acordoc com o id passado - retorna os dados
	public function getVoiceMessage($id){
		return $this->API->get('/audio/' . $id)->data();
	}

}

?>