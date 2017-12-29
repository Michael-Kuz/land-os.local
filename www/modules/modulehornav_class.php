<?php

abstract class ModuleHornav extends Module {
	
	public function __construct() {
		parent::__construct($auth_user=null,$discount=null);
		$this->add("hornav");
	}
	
}

?>