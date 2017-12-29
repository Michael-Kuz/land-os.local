<?php

class AdminOrders extends ModuleHornav{

	private $file_tpl;
	
	public function __construct( $name_file_tpl = "admin_orders" ){
		parent::__construct();
		$this->file_tpl = $name_file_tpl;
		$this->add("title");
		$this->add("method","");
		$this->add("action");
		$this->add("orders");
	}
	
	public function getTmplFile(){
		return $this->file_tpl;
	}
}
?>