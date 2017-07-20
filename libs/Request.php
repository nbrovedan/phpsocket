<?php

final class Request extends Messages{

	private $token;
	private $route;
	private $method;
	//Metodo contrutor, seta os headers padrão, bem como a rota e o metodo
	function __construct($method, $route){
		$this->setHeader($method . " " . $route . " HTTP/1.1");
		$this->setHeader("Connection: close");
		$this->setHeader("Cache-Control: no-cache");
		$this->setHeader("Content-type: application/x-www-form-urlencoded");
	}
	//Adiciona o token ao header se não estiver vazio
	public function setToken($token){
		if(!empty($token)){
			$this->setHeader("Access-Token: " . $token);
		}
		$this->token = $token;
	}
	//Retorna os dados como string adicionando as quebras
	public function toString(){
		//$this->setHeader("Content-Length: " . strlen($this->proccessData()));
		return implode("\r\n", $this->getHeader()) . "\r\n\r\n" . $this->proccessData();
	}
	//Prepara os fields para a requisição
	private function proccessData(){
		return http_build_query($this->getData());
	}
}

?>