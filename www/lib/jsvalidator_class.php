<?php

class JSValidator {
	
	private $message;
	
	public function __construct($message) {
		$this->message = $message;
	}
	
	public function password($f_equal = false, $min_len = true, $t_empty = false) {
		$cl = $this->getBase();
		if ($min_len) {
			$cl->min_len = ValidatePassword::MIN_LEN;
			$cl->t_min_len = $this->message->get(ValidatePassword::CODE_MIN_LEN);
		}
		$cl->max_len = ValidatePassword::MAX_LEN;
		$cl->t_max_len = $this->message->get(ValidatePassword::CODE_MAX_LEN);
		if ($t_empty) $cl->t_empty = $this->message->get($t_empty);
		else $cl->t_empty = $this->message->get(ValidatePassword::CODE_EMPTY);
		if ($f_equal) {
			$cl->f_equal = $f_equal;
			$cl->t_equal = $this->message->get("ERROR_PASSWORD_CONF");
		}
		return $cl;
	}
	
	public function name($t_empty = false, $t_max_len = false, $t_type = false) {
		return $this->getBaseData($t_empty, $t_max_len, $t_type, "ValidateName", "name");
	}
	
	public function city($t_empty = false, $t_max_len = false, $t_type = false) {
		return $this->getBaseData($t_empty, $t_max_len, $t_type, "ValidateCity", "city");
	}
	
	public function address($t_empty = false, $t_max_len = false ) {
		$cl = $this->getBase();
		$cl->type = "address";
		$cl->max_len = ValidateAddress::MAX_LEN;
		if( $t_empty ) $cl->t_empty = $this->message->get($t_empty);
		else $cl->t_empty = $this->message->get(ValidateAddress::CODE_EMPTY);
		if( $t_max_len ) $cl->t_max_len = $this->message->get( $t_max_len );
		else $cl->t_max_len = $this->message->get( ValidateAddress::CODE_MAX_LEN );
		return $cl;
	}
	
	public function discountID($t_empty = false, $t_max_len = false, $t_type = false) {
		return $this->getBaseData($t_empty, $t_max_len, $t_type, "ValidateDiscountID", "discountID");
	}
	
	public function delivery( $t_empty = false ){
		$cl = $this->getBase();
		$cl->type = "delivery";
		if($t_empty) $cl->t_empty = $this->message->get($t_empty);
		else $cl->t_empty = $this->message->get(ValidateDelivery::CODE_EMPTY);
		return $cl;
	}
	
	public function phone($min_len = true, $t_empty = false, $t_max_len = false, $t_type = false) {
		$cl = $this->getBase();
		$cl->type = "phone";
		if($min_len){
			$cl->min_len = ValidatePhone::MIN_LEN;
			$cl->t_min_len = $this->message->get(ValidatePhone::CODE_MIN_LEN);
		}
		$cl->max_len = ValidatePhone::MAX_LEN;
		$cl->t_max_len = $this->message->get(ValidatePhone::CODE_MAX_LEN);
		if($t_empty) $cl->t_empty = $this->message->get($t_empty);
		else $cl->t_empty = $this->message->get(ValidatePhone::CODE_EMPTY);
		if($t_type) $cl->t_type = $this->message->get($t_type);
		else $cl->t_type = $this->message->get(ValidatePhone::CODE_INVALID);
		return $cl;
	}
	
	public function login($t_empty = false, $t_max_len = false, $t_type = false) {
		return $this->getBaseData($t_empty, $t_max_len, $t_type, "ValidateLogin", "login");
	}
	
	public function email($t_empty = false, $t_max_len = false, $t_type = false) {
		return $this->getBaseData($t_empty, $t_max_len, $t_type, "ValidateEmail", "email");
	}
	
	public function textarea($t_max_len = false){
		$cl = $this->getBase();
		$cl->type = "textarea";
		$cl->max_len = ValidateTextarea::MAX_LEN;
		if ($t_max_len) $cl->t_max_len = $this->message->get($t_max_len);
		else $cl->t_max_len = $this->message->get(ValidateTextarea::CODE_MAX_LEN);
		return $cl;
	}
	
	public function textreview($t_empty = false, $t_max_len = false){
		$cl = $this->getBase();
		$cl->type = "textreview";
		$cl->max_len = ValidateTextReview::MAX_LEN;
		if ($t_empty) $cl->t_empty = $this->message->get($t_empty);
		else $cl->t_empty = $this->message->get(ValidateTextReview::CODE_EMPTY);
		if ($t_max_len) $cl->t_max_len = $this->message->get($t_max_len);
		else $cl->t_max_len = $this->message->get(ValidateTextReview::CODE_MAX_LEN);
		return $cl;
	}
	
	public function avatar($default_img=false, $max_len=false, $t_max_len = false, $t_type = false, $max_size=false, $t_max_size=false, $class="ValidateFile", $type="file") {
		$cl = $this->getBase();
		$cl->type = $type;
		if($max_len) $cl->max_len = $max_len;
		else $cl->max_len = $class::MAX_LEN;
		if($max_size) $cl->max_size = $max_size;
		else $cl->max_size = $class::MAX_SIZE;
		if($t_max_len) $cl->t_max_len = $this->message->get($t_max_len);
		else $cl->t_max_len = $this->message->get($class::CODE_MAX_LEN);
		if($t_type) $cl->t_type = $this->message->get($t_type);
		else $cl->t_type = $this->message->get($class::CODE_INVALID);
		if($t_max_size) $cl->t_max_size = $this->message->get($t_max_size);
		else $cl->t_max_size = $this->message->get($class::CODE_MAX_SIZE);
		if($default_img) $cl->default_img = $default_img;
		else $cl->default_img = Config::DIR_AVATAR.Config::DEFAULT_AVATAR;
		
		return $cl;
	}
	
	public function captcha() {
		$cl = $this->getBase();
		$cl->t_empty = $this->message->get("ERROR_CAPTCHA_EMPTY");
		return $cl;
	}
	
	private function getBaseData($t_empty, $t_max_len, $t_type, $class, $type) {
		$cl = $this->getBase();
		$cl->type = $type;
		$cl->max_len = $class::MAX_LEN;
		
		if ($t_empty) $cl->t_empty = $this->message->get($t_empty);
		else $cl->t_empty = $this->message->get($class::CODE_EMPTY);
		if ($t_max_len) $cl->t_max_len = $this->message->get($t_max_len);
		else $cl->t_max_len = $this->message->get($class::CODE_MAX_LEN);
		if ($t_type) $cl->t_type = $this->message->get($t_type);
		else $cl->t_type = $this->message->get($class::CODE_INVALID);
		return $cl;
	}
	
	private function getBase() {
		$cl = new stdClass();
		$cl->type = "";
		$cl->min_len = "";
		$cl->max_len = "";
		$cl->t_min_len = "";
		$cl->t_max_len = "";
		$cl->t_empty = "";
		$cl->t_type = "";
		$cl->f_equal = "";
		$cl->t_equal = "";
		$cl->max_size = "";
		$cl->t_max_size = "";
		$cl->default_img ="";
		return $cl;
	}

}

?>