<?php

class ValidateTPL extends Validator {
	
	protected function validate() {
		$data = $this->data;
		
		if (!is_null($data) && !preg_match("/^[a-z0-9-_]+\.(tpl)$/i", $data)) $this->setError(self::CODE_UNKNOWN);
		
	}
	
}

?>