<?php

class WorksDB extends ObjectDB{

	protected static $table = "works";
	
	public function __construct(){
		parent::__construct( self::$table );
		$this->add("title","ValidateTitle");
		$this->add("icon","ValidateIMG");
		$this->add("full_img","ValidateIMG");
		$this->add("price","ValidatePrice");
		$this->add("bid","ValidatePrice");
		$this->add("n_per_week","ValidateID");
	}
	
	/*=== устанавливаем абсолютные пути если надо ===*/
	protected function postInit(){
		if( !is_null($this->icon) )
			$this->icon = Config::DIR_WORKS_IMG.$this->icon;
		if( !is_null($this->full_img) )
			$this->full_img = Config::DIR_WORKS_IMG.$this->full_img;	
	}
	/*=== считываем все работы из таблицы works ===*/
	public function getWorks(){
		return WorksDB::getAll();
	}
}
?>