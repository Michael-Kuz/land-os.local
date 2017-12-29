<?php

class ValidateCity extends Validator {
	
	const MAX_LEN = 100;
	const CODE_EMPTY = "ERROR_CITY_EMPTY";
	const CODE_INVALID = "ERROR_CITY_INVALID";
	const CODE_MAX_LEN = "ERROR_CITY_MAX_LEN";
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0) $this->setError(self::CODE_EMPTY);
		else {
			if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);
			elseif ($this->isContainQuotes($data)) $this->setError(self::CODE_INVALID);
		}
	}
	
}

?>