<?php

class Logo extends Module {
	
	public function __construct() {
		parent::__construct($auth_user=null,$discount=null);
		$this->add("img");
	}
	
	public function getTmplFile() {
		return "logo";
	}
	
}

?>