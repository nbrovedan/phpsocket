<?php

define('_POST_', 'POST');
define('_PUT_', 'PUT');
define('_GET_', 'GET');
define('_DELETE_', 'DELETE');

class API{

  	private $socket;
  	
	function __construct(){
		//Cria o socket
 		$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
 	}
	//Função para escrever a requisição no Socket
 	private function send($req){
 		//Seta o header Host
 		$req->setHeader("Host: " . Config::$server['url']);
 		//Conecta o socket
		if(!socket_connect($this->socket, gethostbyname(Config::$server['url']), Config::$server['port'])){
 			throw new Exception("Falha ao conectar o socket ao servidor " . Config::$server['url'] . ":" . Config::$server["port"] . "!<BR />Erro: " . socket_strerror(socket_last_error($this->socket)) , 1);
 		}
 		//Escreve a requisicao
 		if(!socket_write($this->socket, $req->toString(), strlen($req->toString()))){
 			throw new Exception("Falha ao efetuar a requisição!<BR />Erro: " . socket_strerror(socket_last_error($this->socket)) , 1);
 		}
 		//Cria um novo objeto response
 		$res = new Response();
		//Inicializa a variável result com vazio
 		$result = '';
 		//aguarda a leitura do resultado
 		while ($temp = socket_read($this->socket, 2048)) {
			//Adiciona todo resultado
			$result .= $temp;
		}
		//Atribui o resultado ao result do response
		$res->setResult($result);
		//Fecha a conexao
		socket_close($this->socket);
		//Retorna o objeto response
		return $res;
 	}
	//Método GET
	public function get($route){
		//Cria um objeto request e adiciona a rota no header
		$req = new Request(_GET_, $route);
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
	//Método PUT
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
	//Método POST
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
	//Método DELETE
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