<?php
	
abstract class Messages{
	//Atributos necessários para a requisição
	private $header = array();
	private $data = array();
	private $result;


	public function getHeader(){
		return $this->header;
	}

	public function getData(){
		return $this->data;
	}

	public function getResult(){
		return $this->result;
	}
	//Adiciona o header sempre no final do array
	public function setHeader($header){
		array_push($this->header, $header);
	}
	//Adiciona os valores com a chave passada
	public function setData($key, $data){
		$this->data[$key] = $data;
	}
	
	public function setResult($result){
		$this->result = $result;
	}
	//Assinatura do método
	public abstract function toString();
}

?>