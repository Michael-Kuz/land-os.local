<?php

class ValidateDiscountID  extends Validator {
	
	const MAX_LEN = 15;
	const CODE_EMPTY = "ERROR_NAME_EMPTY";
	const CODE_INVALID = "ERROR_DISCOUNTID_INVALID";
	const CODE_MAX_LEN = "ERROR_DISCOUNTID_MAX_LEN";
	protected function validate() {
		$data = $this->data;
		if( is_string($data) && mb_strlen($data)>self::MAX_LEN  )  $this->setError(self::CODE_MAX_LEN);
		elseif ($this->isContainQuotes($data)) $this->setError(self::CODE_INVALID);
	}
	
}