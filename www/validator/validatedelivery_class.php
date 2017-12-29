<?php

class ValidateDelivery extends Validator {
	
	const CODE_EMPTY = "ERROR_DELIVERY_EMPTY";
		
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0) $this->setError(self::CODE_EMPTY);
	}
	
}

?>