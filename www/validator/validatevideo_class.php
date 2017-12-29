<?php

class Validatevideo extends Validator {
	
	protected function validate() {
		$data = $this->data;
		if (!is_null($data) && !preg_match("/^[a-z0-9-_]+\.(webm|mp4|ogv)$/i", $data)) $this->setError(self::CODE_UNKNOWN);
	}
	
}

?>