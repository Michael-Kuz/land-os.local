<?php

class AdminDiagrams extends ModuleHornav{

	private $file_tpl;
	
	public function __construct( $name_file_tpl = "admin_diagrams" ){
		parent::__construct();
		$this->file_tpl = $name_file_tpl;
		$this->add("sectors", NULL, true);
	}
	
	public function getTmplFile(){
		return $this->file_tpl;
	}
}
?>