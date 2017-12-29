<?php

class ValidatePrice extends Validator {
	
	protected function validate() {
		$data =  $this->data;
		if ( !is_null($data) && (!is_numeric($data) || $data < 0) ) { 
			$this->setError(self::CODE_UNKNOWN);
		}
	}
}

?>