<?php

class CampsDB extends ObjectDB{

	protected static $table = "lan_camps";
	
	public function __construct(){
		parent::__construct(self::$table);
		$this->add("ip","ValidateIP",self::TYPE_IP);
		$this->add("utm_source","ValidateSmallText");
		$this->add("utm_campaing","ValidateSmallText");
		$this->add("utm_content","ValidateSmallText");
		$this->add("utm_term","ValidateSmallText");
		$this->add("ref","ValidateURL");
		$this->add("date","ValidateDate",self::TYPE_TIMESTAMP);
	}

	/*--- Функция проверки наличия рекламной компании в базе данных ---*/
	/*--- В случае наличия функция возвращает id рекламной компании ---*/
	public function getCampID(){
		/*--- формируем строку Where с ? вместо конкретных данных ---*/
		$where = "";
		$value = array();
		$and = " AND ";
		$data = $this->getProperties();
		foreach( $data as $key=>$v ){
			if( $key=="ref" || $key=="date" )
				continue;
			if( is_null($v) ){
				$where .= "`$key` IS ".self::$db->getSQ().$and;
			}else{
				$where .= "`$key` = ".self::$db->getSQ().$and;
			}
			$value[] = $v;
		}
		$where = substr( $where, 0, -strlen($and) ); // убираем в конце строки лишний " AND "
		return CampsDB::getFieldOnWhere(self::$table, __CLASS__, array("id"), $where, $value );
	}
	
	/*--- Добавление рекламной компании в базу данных ---*/
	public static function addCamp( $data ){
		$this->save();
		if( !$this->id ) return false;
		return $this->id;
	}
}
?>