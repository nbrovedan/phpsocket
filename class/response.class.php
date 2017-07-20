<?php
	
	require_once 'messages.class.php';

	final class Response extends Messages{

		private $statusCode;
		private $message;

		public function getStatusCode(){
			return $this->statusCode;
		}

		public function getMessage(){
			return $this->message;
		}

		public function setStatusCode($statusCode){
			$this->statusCode = $statusCode;
		}

		public function setMessage($message){
			$this->message = $message;
		}
		//override
		public function setResult($result){
			$this->result = $result;
			$this->processResult();
		}
		//override
		public function getResult(){
			return $this->result;
		}
		//Retorna o response como array
		public function toString(){
			return explode("\r\n\r\n", $this->getResult());
		}
		//Retorna apenas o body
		public function data(){
			if(count(explode("\r\n\r\n", $this->getResult())) > 1){
				if($this->getStatusCode() == 200){
					$data = explode("\r\n\r\n", $this->getResult());	
					$return = '';
					foreach ($data as $key => $value) {
						if($key > 0){
							$return .= $value;
						}
					}
					return $return;
				}else{
					return $this->getStatusCode() . ' - ' . $this->getMessage();
				}
			}else{
				return "Empty result";
			}
		}
		//Processa o result e atribui o statusCode e message
		public function processResult(){
			if(!empty($this->getResult())){
				$this->setStatusCode(substr($this->getResult(), 9, 3));
				$this->setMessage(substr($this->getResult(), 13, strpos(substr($this->getResult(), 13, -1), PHP_EOL)));
			}
		}
	}

?>