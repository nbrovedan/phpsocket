<?php
	
	require_once 'messages.class.php';

	final class Request extends Messages{

		private $token;
		private $route;
		private $method;
		
		function __construct($method, $route){
			//Configura o headers
			$this->setHeader($method . " " . $route . " HTTP/1.1");
			$this->setHeader("Connection: close");
			$this->setHeader("Cache-Control: no-cache");
			$this->setHeader("Content-type: application/x-www-form-urlencoded");
		}
		//Adiciona o token ao header
		public function setToken($token){
			if(!empty($token)){
				$this->setHeader("Access-Token: " . $token);
			}
			$this->token = $token;
		}
		//Retorna os dados como string
		public function toString(){
			$this->setHeader("Content-Length: " . strlen($this->proccessData()));
			return implode("\r\n", $this->getHeader()) . "\r\n\r\n" . $this->proccessData();
		}
		//Prepara os fields para a requisição
		private function proccessData(){
			return http_build_query($this->getData());
		}
	}

?>