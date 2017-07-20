<?php
	
abstract class Messages{
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

	public function setHeader($header){
		array_push($this->header, $header);
	}

	public function setData($key, $data){
		$this->data[$key] = $data;
	}

	public function setResult($result){
		$this->result = $result;
	}

	public abstract function toString();
}

?>