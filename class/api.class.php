<?php

define('_POST_', 'POST');
define('_PUT_', 'PUT');
define('_GET_', 'GET');
define('_DELETE_', 'DELETE');

require_once 'response.class.php';
require_once 'request.class.php';
require_once 'config/config.class.php';

class API{

  	private $socket;
  	private static $token;

 	function __construct(){
 		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
 	}

 	private function send($req){
 		//Seta o header Host
 		$req->setHeader("Host: " . Config::$server['url'] . ':' . Config::$server['port']);
 		//Conecta o socket
 		if(!socket_connect($this->socket, 'ssl://'.Config::$server['url'], Config::$server['port'])){
 			throw new Exception("Falha ao conectar o socket ao servidor " . Config::$server['url'] . ":" . Config::$server["port"] . "!<BR />Erro: " . socket_strerror(socket_last_error($this->socket)) , 1);
 		}
 		
 		//Escreve a requisicao
 		if(!socket_write($this->socket, $req->toString(), strlen($req->toString()))){
 			throw new Exception("Falha ao efetuar a requisição!<BR />Erro: " . socket_strerror(socket_last_error($this->socket)) , 1);
 		}
 		//Cria um novo objeto response
 		$res = new Response();
 		$result = '';
 		//aguarda a leitura do resultado
 		while ($temp = socket_read($this->socket, 2048)) {
			//Adiciona todo resulta
			$result .= $temp;
		}
		//Atribui o resultado ao result do response
		$res->setResult($result);
		//Fecha a conexao
		socket_close($this->socket);
		//Retorna o objeto response
		return $res;
 	}

	public function get($route){
		//Cria um objeto request e adiciona a rota no header
		$req = new Request(_GET_, $route);
		//Envia a requisição
		try{
			$res = $this->send($req);
		}catch(Exception $e){
			echo $e->getMessage();
			return;
		}
		//Retorna o resultado
		return $res;
	}

	public function put($route, $data){
		//Cria um novo objeto request
		$req = new Request(_PUT_,$route);
		//Seta o token
		$req->setToken(Config::$token);
		//Seta os parâmetros
		foreach ($data as $key => $value) {
			$req->setData($key,$value);
		}
		//Envia a requisição
		try{
			$res = $this->send($req);
		}catch(Exception $e){
			echo $e->getMessage();
			return;
		}
		//Retorna o resultado
		return $res;
	}

	public function post($route, $data){
		//Cria um novo objeto request
		$req = new Request(_POST_,$route);
		$req->setToken(Config::$token);
		//Seta os parâmetros
		foreach ($data as $key => $value) {
			$req->setData($key,$value);
		}
		//Envia a requisição
		try{
			$res = $this->send($req);
		}catch(Exception $e){
			echo $e->getMessage();
			return;
		}
		//Retorna o resultado
		return $res;
	}

	public function delete($route){
		//Cria o objeto
		$req = new Request(_DELETE_,$route);
		//Seta o token
		$req->setToken(Config::$token);
		//Envia a requisição
		try{
			$res = $this->send($req);
		}catch(Exception $e){
			echo $e->getMessage();
			return;
		}
		//Retorna o resultado
		return $res;
	}


}

?>