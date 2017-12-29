<?php

class ValidatePassword extends Validator {
	
	const MIN_LEN = 1;
	const MAX_LEN = 32;
	const CODE_EMPTY = "ERROR_PASSWORD_EMPTY";
	const CODE_CONTENT = "006:ERROR_PASSWORD_CONTENT";
	const CODE_MIN_LEN = "006:ERROR_PASSWORD_MIN_LEN";
	const CODE_MAX_LEN = "006:ERROR_PASSWORD_MAX_LEN";
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0) $this->setError(self::CODE_EMPTY);
		else {
			if (mb_strlen($data) < self::MIN_LEN) $this->setError(self::CODE_MIN_LEN);
			elseif (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);
			elseif (!preg_match("/^[a-z0-9_]+$/i", $data)) $this->setError(self::CODE_CONTENT);
		}
	}
	
}

?>