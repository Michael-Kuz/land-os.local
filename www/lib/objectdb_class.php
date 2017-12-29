<?php

abstract class ObjectDB extends AbstractObjectDB {
	
	private static $months = array("янв", "фев", "март", "апр", "май", "июнь", "июль", "авг", "сен", "окт", "ноя", "дек");
	
	public function __construct($table) {
		parent::__construct($table, Config::FORMAT_DATE);
	}
	//====== генерируем список других продуктов методом генератора случ чисел
	protected static function getRandOthers( $values ){
		if( count($values)<= Config::COUNT_OTHERS ) return $values;
		$ret = array();
		$keys = array_rand( $values, Config::COUNT_OTHERS ); 
		$i=0;
		foreach( $keys as $key ){
			$ret[$i] = $values[$key];
			$i++;
		}
		return $ret;
	}
	protected static function getMonth($date = false) {
		if ($date) $date = strtotime($date);
		else $date = time();
		return self::$months[date("n", $date) - 1];
	}
	
	public function preEdit($field, $value) {
		return true;
	}
	
	public function postEdit($field, $value) {
		return true;
	}
	
	public function accessEdit($auth_user, $field) {
		return false;
	}
	
	public function accessDelete($auth_user) {
		return false;
	}
	
}

?>