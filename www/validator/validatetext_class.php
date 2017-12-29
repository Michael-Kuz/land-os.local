<?php

class ValidateText extends Validator {
	
	const MAX_LEN = 50000;
	const CODE_MAX_LEN = "ERROR_TEXT_MAX_LEN";
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);
	}
	
}

?>