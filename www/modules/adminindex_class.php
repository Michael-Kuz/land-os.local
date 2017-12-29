<?php

class AdminIndex extends ModuleHornav{

	private $file_tpl;
	
	public function __construct( $name_file_tpl = "admin_index" ){
		parent::__construct();
		$this->file_tpl = $name_file_tpl;
		$this->add("title");
		$this->add("action");
		$this->add("method");
		$this->add("total_orders");
		$this->add("confirm_orders");
		$this->add("paid_orders");
		$this->add("cancel_orders");
		$this->add("total_summ");
		$this->add("confirm_sum");
		$this->add("paid_sum");
		$this->add("cancel_sum");
		$this->add("data_form", NULL, true);
		$this->add("diagrams");
	}
	
	public function getTmplFile(){
		return $this->file_tpl;
	}
}
?>