<?php

class Message {
	
	private $data;
		
	public function __construct($file) {
		$this->data = parse_ini_file($file);
	}
	
	public function get($name) {
		$tmp = explode(":",$name); //если есть префикс кода ошибки, сначало убираем его
		if( count($tmp) == 2 )
			return $this->data[$tmp[1]];
		elseif( count($tmp) == 1 )
			return $this->data[$tmp[0]];
	}
	
}

?>