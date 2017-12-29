<?php

class Topmenu extends Module{

	public function __construct(){
		parent::__construct();
		$this->add("uri");
		$this->add("items");
	}
	
	public function getTmplFile(){
		return "topmenu";
	}
}
?>