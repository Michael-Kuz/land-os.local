<?php

abstract class AbstractController {
	
	protected $view;
	protected $request;
	protected $fp = null;
	protected $auth_user = null;
	protected $auth_admin = null;
	protected $add_new_review = null; //указывает на наличие нового отзыва
	protected $jsv = null;
	protected $discount_id = null;
		
	public function __construct($view, $message) {
		if (!session_id()) session_start();
		$this->view = $view;
		$this->request = new Request();
		$this->fp = new FormProcessor($this->request, $message);
		$this->jsv = new JSValidator($message);
		$this->auth_user = $this->authUser();
		$this->auth_admin = $this->authAdmin();
		$this->discount_id = $this->discount_id();
		if (!$this->access()) {
			$this->accessDenied();
			throw new Exception("ACCESS_DENIED");
		}
	}
	
	abstract protected function render($str);
	abstract protected function accessDenied();
	abstract protected function action404();
	abstract protected function inDeveloping();
	
	protected function authUser() {
		return null;
	}
	
	protected function authAdmin() {
		return null;
	}
	
	protected function discount_id() {
		if( $this->auth_user ) 
			return $this->auth_user->discount_id;
		return null;
	}
	
	protected function access() {
		return true;
	}
	
	
	protected function notFound() {
		$this->action404();
	}
	
	//=== API smsaero.ru (посылка уведомляющей смс о поступлении нового заказа на заданный номер)
	protected function sendOrder( $phone ) {
		$text = "Новый заказ herbal24 $phone";
		$text = urlencode( $text );
		$result = file_get_contents("https://gate.smsaero.ru/send/?user=".Config::SMS_USER."&password=".md5(Config::SMS_PASSWORD)."&to=".Config::SMS_PHONE."&text=$text&from=".Config::SMS_SIGNATURE);
	}
	
	//=== API smsaero.ru (посылка уведомляющей смс об оплате нового заказа на заданный номер)
	protected function sendSMSOrderPay( $phone ) {
		$text = "Оплата заказа herbal24 $phone";
		$text = urlencode( $text );
		$result = file_get_contents("https://gate.smsaero.ru/send/?user=".Config::SMS_USER."&password=".md5(Config::SMS_PASSWORD)."&to=".Config::SMS_PHONE."&text=$text&from=".Config::SMS_SIGNATURE);
	}
	
	final protected function redirect($url) {
		header("Location: $url");
		exit;
	}
	
	final protected function renderData($modules, $layout, $params = array()) {
		if (!is_array($modules)) return false;
		foreach ($modules as $key => $value) {
			$params[$key] = $value;
		}
		return $this->view->render($layout, $params, true);
	}
	
	//====== Циклически меняет флаг в сессии для отображения нужного куска сонтента
	protected function DisplayContent($name){
		if( !$_SESSION[$name] ) $_SESSION[$name] = true;
		elseif( $_SESSION[$name] ) $_SESSION[$name] = false;
	}
	
	//====== Открываем класс соответствующего обьекта продукции
	public function getProductClass( $section_id ){
		return $this->getClassOnSection( $section_id );
	}
	
	//====== получаем тип обьекта по ID секции
	protected function getClassOnSection( $section_id ){
		switch( $section_id ){
			case 1:
			case 2:
				return new FoodDB();
			case 3:
				return new ComplexProgDB();
			case 4:
				return new RecipesDB();	
			case 5:
				return new CosmeticsDB();
			case 6:
				return new TargetDB();
			case 7:
				return new VideoDB();	
		}
		$this->notFound();
		exit;
	}
	
	//== расчитываем сумму, на которую нужно добавить продукт в корзину, для получения бесплатной доставки 
	protected function summForFreeDelivery(){
		if( !session_id() ) session_start();
		if( isset($_SESSION["cart"]) && $_SESSION["cart"] != "" ){
			$_SESSION["ForFreeDelivery"] = Config::SUMM_FOR_FREE_DELIVERY;
			$ids = explode( ",",$_SESSION["cart"] );
			foreach( $ids as $value){
				$tmp = explode( "->",$value );
				$section_id = $tmp[0];
				$id = $tmp[1];
				if( $_SESSION["ForFreeDelivery"] == 0 )
					break;
				if( $section_id == 1 && ($id == 20 || $id == 21 || $id == 22) )  
					continue;
				$product_db = $this->getProductClass( $section_id ); //== открываем нужный тип обьекта по ID секции
				$product_db->load($id);
				$_SESSION["ForFreeDelivery"] -= $product_db->price_25;
				if( $_SESSION["ForFreeDelivery"] <= 0 )
					$_SESSION["ForFreeDelivery"] = 0;
			}	
		}
		else $_SESSION["ForFreeDelivery"] = Config::SUMM_FOR_FREE_DELIVERY;
	}
	
	
}

?>