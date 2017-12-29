<?php

class FormProcessor {
	
	private $request;
	private $message;
	
	public function __construct($request, $message) {
		$this->request = $request;
		$this->message = $message;
	}
	
	public function process($message_name, $obj, $fields, $checks = array(), $success_message = false) {
		try {
			if (is_null($this->checks($message_name, $checks))) return null;
			foreach ($fields as $field) {
				if (is_array($field)) {
					$f = $field[0];
					$v = $field[1];
					if (strpos($f, "()") !== false) {
						$f = str_replace("()", "", $f);
						$obj->$f($v);
	                }
					else $obj->$f = $v;
				}
				else{ 
					$obj->$field = $this->request->$field;
				}
			}
			if ($obj->save()) {
				if ($success_message) $this->setSessionMessage($message_name, $success_message);
				return $obj;
			}
			else{
				$this->setSessionMessage($message_name, $this->getError($e));
			}
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return null;
		}
	}
	
	public function checks($message_name, $checks) {
		try {
			for ($i =0; $i < count($checks); $i++) {
				$equal = isset($checks[$i][3])? $checks[$i][3]: true;
				if ($equal && ($checks[$i][0] != $checks[$i][1])){ 
					throw new Exception($checks[$i][2]); 
				}elseif (!$equal && ($checks[$i][0] == $checks[$i][1])) {
					throw new Exception($checks[$i][2]);
				}
			}
			return true;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return null;
		}
	}
	
	public function auth($message_name, $obj, $method, $login, $password) {
		try {
			$user = $obj::$method($login, $password);
			return $user;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return false;
		}
	}
	
	public function authOnDiscountID($message_name, $obj, $method, $discount_id) {
		try {
			$user = $obj::$method($discount_id);
			return $user;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return false;
		}
	}
	
	public function setSessionMessage($to, $message) {
		if (!session_id()) session_start();
		$tmp = explode(":",$message);
		if( count($tmp) == 2 ){
			$_SESSION["error_code"] = array( $to=>$tmp[0] );
			$_SESSION["message"] = array($to=>$tmp[1]);
		}elseif( count($tmp) == 1 ){
			$_SESSION["message"] = array($to => $tmp[0]);
		}
	}
	
	public function getSessionMessage($to) {
		if (!session_id()) session_start();
		if (!empty($_SESSION["message"]) && !empty($_SESSION["message"][$to])) {
			$message = $_SESSION["message"][$to];
			unset($_SESSION["message"][$to]);
			unset($_SESSION["error_code"][$to]);
			return $this->message->get($message);
		}
		return false;
	}
	
	public function getSessionErrorCode($to) {
		if (!session_id()) session_start();
		if (!empty($_SESSION["error_code"]) && !empty($_SESSION["error_code"][$to])) {
			$message = $_SESSION["error_code"][$to];
			return $message;
		}
		return false;
	}
	
	//=== получение сообщения об ошибки из файла минуя сессию
	public function getMessage( $message ){
		return $this->message->get($message);
	}
	
	public function uploadIMG($message_name, $file, $max_size, $dir, $source_name = false) {
		try {
			$name = File::uploadIMG($file, $max_size, $dir, false, $source_name);
			return $name;
		} catch (Exception $e) {
			$this->setSessionMessage($message_name, $this->getError($e));
			return false;
		}
	}
	
	private function getError($e) {
		if ($e instanceof ValidatorException) {
			$error = current($e->getErrors());
			return $error[0];
		}
		elseif (($message = $e->getMessage())) return $message;
		return "UNKNOWN_ERROR";
	}
	
}

?>