<?php

class OrderDB extends ObjectDB{

	protected static $table = "lan_orders";
	
	public function __construct(){
		parent::__construct( self::$table );
		$this->add("name","ValidateName");
		$this->add("price", "ValidatePrice");
		$this->add("phone", "ValidatePhone");
		$this->add("email", "ValidateEmail");
		$this->add("date_order", "ValidateDate", self::TYPE_TIMESTAMP );
		$this->add("date_confirm", "ValidateDate", self::TYPE_TIMESTAMP);
		$this->add("date_pay", "ValidateDate", self::TYPE_TIMESTAMP);
		$this->add("date_cancel", "Validatedate", self::TYPE_TIMESTAMP);
		$this->add("camp_id", "ValidateID");
		$this->add("split", "ValidateSplit");
		$this->add("func", "ValidateSplit");
	}

	public static function getFieldsFromTableCamps( $fields ){
		$select = new Select();
		$select->from( "lan_camps", $fields );
		$data = self::$db->selectCol($select);
		return $data;
	}
	
	public static function getWhereForOrders( $data ){
		$log = $data["log"];
		$where = "";
		$ft = "";
		
		/*формируем диапазон времени*/
		if( $data["from"] || $data["to"] ){
			if( $data["from"] ){
				$ft = " date_order > '".strtotime( $data["from"] )."'";
			}
			if( $data["to"] ){
					$temp = "date_order < '".strtotime( $data["to"] )."'"; 
				if( $ft ){
					$ft .= " AND $temp";
				}else{
					$ft = $temp;
				}
			}
		}
		
		/*формируем where для utm - меток*/
		$where_utms = "";
		$utms = array();
		$utms["utm_source"] = $data["utm_source"];
		$utms["utm_campaing"] = $data["utm_campaing"];
		$utms["utm_content"] = $data["utm_content"];
		$utms["utm_term"] = $data["utm_term"];
		$utms["ref"] = $data["ref"];
		$utms["date"] = $data["date"];
		foreach( $utms as $key=>$value ){
			if( $value ){
				if( $where_utms ){
					$where_utms .= " $log $key = '$value'";
				}else{
					$where_utms = "$key = '$value'";
				}
			}
		}
		
		/*формируем дополнительные where*/
		$where_add = "";
		$adds = array();
		$adds["split"] = $data["split"];
		$adds["func"] = $data["func"];
		foreach( $adds as $key=>$value ){
			if( $value ){
				if( $where_add ){
					$where_add .= " AND $key = '$value'";
				}else{
					$where_add = " $key = '$value'";
				}
			}
		}
		
		/*собирает все составляющие where*/
		if( $ft ){
			$where .= "$ft";
		}
		if( $where_add ){
			if( $where ){
				$where .= " AND $where_add";
			}else{
				$where = "$where_add";
			}
		}
		if( $where_utms ){
			$temp = "camp_id IN ( SELECT id FROM ".Config::DB_PREFIX."lan_camps WHERE $where_utms)";
			if( $where ){
				$where .= " AND $temp";
			}else{
				$where = "$temp";
			}
		}
		return $where;
	}
	
	public static function getCountIDOnWhere( $query = "" ){
		return OrderDB::getCountOnWhere( self::$table, $query );
	}
	
	public static function getConfirmOrders( $query = "" ){
		$temp = "`date_confirm` IS NOT NULL";
		if( $query ){
			$query = $temp." AND ".$query;
		}
		else{
			$query = $temp;
		}
		return OrderDB::getCountOnWhere( self::$table, $query );
	}
	
	public static function getPaidOrders( $query = "" ){
		$temp = "`date_pay` IS NOT NULL";
		if( $query ){
			$query = $temp." AND ".$query;
		}
		else{
			$query = $temp;
		}
		return OrderDB::getCountOnWhere( self::$table, $query );
	}
	
	public static function getCancelOrders( $query = "" ){
		$temp = "`date_cancel` IS NOT NULL";
		if( $query ){
			$query = $temp." AND ".$query;
		}
		else{
			$query = $temp;
		}
		return OrderDB::getCountOnWhere( self::$table, $query );
	}
	
	public static function getTotalSum( $query = "" ){
		return OrderDB::getSumOnWhere( self::$table, "price", $query );
	}
	
	public static function getConfirmSum( $query = "" ){
		$temp = "`date_confirm` IS NOT NULL";
		if( $query ){
			$query = $temp." AND ".$query;
		}
		else{
			$query = $temp;
		}
		return OrderDB::getSumOnWhere( self::$table, "price", $query );
	}
	
	public static function getPaidSum( $query = "" ){
		$temp = "`date_pay` IS NOT NULL";
		if( $query ){
			$query = $temp." AND ".$query;
		}
		else{
			$query = $temp;
		}
		return OrderDB::getSumOnWhere( self::$table, "price", $query );
	}
	
	public static function getCancelSum( $query = "" ){
		$temp = "`date_cancel` IS NOT NULL";
		if( $query ){
			$query = $temp." AND ".$query;
		}
		else{
			$query = $temp;
		}
		return OrderDB::getSumOnWhere( self::$table, "price", $query );
	}
	
	public static function getAllDesc($count = false, $offset = false) {
		$class = get_called_class();
		return self::getAllWithOrder($class::$table, $class, "id", false, $count, $offset);
	}
}
?>