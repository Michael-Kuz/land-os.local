<?php
class MenuDB extends ObjectDB {
	
	const TOPMENU = 1;
	const TOPMENU_ADMIN = 2;
		
	protected static $table = "menu";
	
	public function __construct() {
		parent::__construct(self::$table);
		$this->add("type", "ValidateID");
		$this->add("title", "ValidateTitle");
		$this->add("link", "ValidateURL");
		$this->add("hidden", "ValidateBoolean");
		$this->add("parent_id", "ValidateID");
		$this->add("external", "ValidateBoolean");
	}
		
	public static function getTopMenu() {
		return ObjectDB::getAllOnWhere(self::$table, __CLASS__, "type = ".self::$db->getSQ()." AND hidden = ".self::$db->getSQ(), array(MenuDB::TOPMENU, 0) );
	}
	
	public static function getTopMenuAdmin() {
		return ObjectDB::getAllOnField(self::$table, __CLASS__, "type", MenuDB::TOPMENU_ADMIN , "id");
	}
}

?>