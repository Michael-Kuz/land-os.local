<?php

class ValidateFile extends Validator{
	
	const MAX_LEN = 100;
	const MAX_SIZE = Config::MAX_SIZE_AVATAR;
	const CODE_EMPTY = "ERROR_FILE_EMPTY";
	const CODE_INVALID = "ERROR_AVATAR_TYPE";
	const CODE_MAX_LEN = "ERROR_AVATAR_LEN";
	const CODE_MAX_SIZE = "ERROR_AVATAR_SIZE";
	
	protected function validate() {
		
	}
}

?>