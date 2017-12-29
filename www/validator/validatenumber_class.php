<?php

class ValidateNumber extends Validator {
	
	const MAX_LEN = 11;
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_UNKNOWN);
	}
}

?>