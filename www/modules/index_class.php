<?php

class Index extends ModuleHornav{

	private $file_tpl;
	
	public function __construct( $name_file_tpl = "index" ){
		parent::__construct();
		$this->file_tpl = $name_file_tpl;
		$this->add("title");
		$this->add("items_adv");
		$this->add("items_stp");
		$this->add("items_eff");
		$this->add("items_works");
		$this->add("items_guar");
		$this->add("top_form");
		$this->add("bottom_form");
		$this->add("split");
	}
	
	public function getTmplFile(){
		return $this->file_tpl;
	}
}
?>