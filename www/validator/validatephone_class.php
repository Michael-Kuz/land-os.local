<?php

class ValidatePhone extends Validator {
	
	const MIN_LEN = 10;
	const MAX_LEN = 20;
	const CODE_EMPTY = "ERROR_PHONE_EMPTY";
	const CODE_INVALID = "ERROR_PHONE_INVALID";
	const CODE_MIN_LEN = "ERROR_PHONE_MIN_LEN";
	const CODE_MAX_LEN = "ERROR_PHONE_MAX_LEN";
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) < self::MIN_LEN) $this->setError(self::CODE_MIN_LEN);
		else if(mb_strlen($data) < self::MIN_LEN && mb_strlet(data) == 0) $this->setError(self::CODE_EMPTY);
		else {
			if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);
			elseif ($this->isContainQuotes($data)) $this->setError(self::CODE_INVALID);
		}
	}
	
}

?>