<?php

class ValidateVP extends Validator {
	
	protected function validate() {
		$data =  $this->data;
		if ( !is_numeric($data) || $data < 0 ) $this->setError(self::CODE_UNKNOWN);
	}
	
}

?>