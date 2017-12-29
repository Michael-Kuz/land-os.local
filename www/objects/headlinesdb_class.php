<?php

class HeadlinesDB extends ObjectDB{
	
	protected static $table = "headlines";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add("utm_term","ValidateSmallText");
		$this->add("hedline","ValidateSmallText");
	}
	
	/*--- возвращает заголовок по полученной ключевой фразе utm_term ---*/
	public static function getHeadline($utm_term){
		return HeadlinesDB::getFieldOnWhere( self::$table, __CLASS__, array("headline"), "`utm_term` = ".self::$db->getSQ(), array($utm_term) ); 
	}
}
?>