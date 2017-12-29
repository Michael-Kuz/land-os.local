<?php

class Form extends ModuleHornav {
	
	private $file_tpl;
	
	public function __construct( $name_file_tpl = "popup" ) {
		parent::__construct();
		$this->file_tpl = $name_file_tpl;
		$this->add("name");
		$this->add("action");
		$this->add("method", "post");
		$this->add("header");
		$this->add("message");
		$this->add("check", true);
		$this->add("enctype");
		$this->add("inputs", null, true);
		$this->add("jsv", null, true);
	}
	
	public function addJSV($field, $jsv) {
		$this->addObj("jsv", $field, $jsv);
	}
	
	//=== добавление нужных переменных в DIV блок, который находится в теле формы
	public function addDIV( $names = array() ){
		foreach( $names as $name )
			$this->add($name);
	}
		
	public function getTmplFile() {
		return $this->file_tpl;
	}
	
}

?>