<?php

class ValidateTextReview extends Validator {
	
	const MAX_LEN = 255;
	const CODE_EMPTY = "ERROR_TEXT_EMPTY";
	const CODE_MAX_LEN = "ERROR_TEXT_MAX_LEN";
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) == 0 ) $this->setError(self::CODE_EMPTY);
		else if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_MAX_LEN);
	}
	
}

?>