<?php
class Manage extends Controller {

	public function __construct(){
		parent::__construct();
		
	}
		
	/*=== Функция обработки данных полученных из формы запроса оформить заявку ===*/
	public function landing_order(){
		$message_name = "landing_order";
		//сначало надо проверить КАПТЧУ(captchar)
		if( $this->request->func ){
			$captcha = $this->request->captcha;
			$checks = array(array(Captcha::check($captcha), $captcha, "ERROR_CAPTCHA_CONTENT"));
			if( $this->fp->checks( $message_name, $checks ) ){
				$lan_order = new OrderDB(); //открываем новый обьект OrderDB
				/*--- Формируем массив соответствия ключей базы данных с ключами формы ---*/
				$fields = array( "name",
								 "price",
								 "phone",
								 "email",
								 array("date_order", date("d.m.Y G:i:s") ),
								 "date_confirm",
								 "date_pay",
								 "date_cancel",
								 array("camp_id", ( isset( $_SESSION["camp_id"] ) ) && $_SESSION["camp_id"] ? $_SESSION["camp_id"] : NULL ),
								 array("split", ( isset( $_SESSION["split"] ) ) && $_SESSION["split"] ? $_SESSION["split"] : NULL ),
								 "func"
				);
				/*--- Проверяем и записываем данные в таблицу lan_orders ---*/
				$lan_order = $this->fp->process($message_name, $lan_order, $fields);
				if( $lan_order instanceof OrderDB ) { // если обьект создан и его тип соответствует обьекту OrderDB
					$this->mail->setFrom($lan_order->email);//устанавливаем адрес мэйла заказчика
					$this->mail->setFromName($lan_order->name);//устанавливаем имя заказчика
					/*--- отправляем письмо на адрес администратора ---*/
					if( $this->mail->send( Config::ADM_EMAIL, array("name"=>$lan_order->name, "phone"=>$lan_order->phone, "email"=>$lan_order->email,"date_send"=>$lan_order->date_order), "call_back"  ) ){
						$this->fp->setSessionMessage( $message_name, "SUCCESS_MESSAGE_SEND" );
						//Отправляем SMS-уведомление о поступлении нового заказа
						$this->sendSmsNewOrder( $lan_order->phone );
					}else{
						$this->fp->setSessionMessage( $message_name, "UNKNOWN_ERROR_SEND" );
					}
				}
			}else{ 
				$this->fp->setSessionMessage( $message_name, "ERROR_CAPTCHA_CONTENT" );	
			}	
			
			$data = array("send"=>false, "text"=>$this->fp->getSessionMessage( $message_name ) );
			echo json_encode($data);
			exit;
		}
	}
	/* Обработка данных полученных из формы авторизации админа(.form-admin-auth) */
	public function admin_auth(){
		$captcha = $this->request->captcha;
		$checks = array(array(Captcha::check($captcha), $captcha, "ERROR_CAPTCHA_CONTENT"));
		if( $this->fp->checks( $this->request->message_name, $checks ) ){
			$this->login( $this->request->login,$this->request->password );
			if( $this->auth_admin !== NULL ){
				$data = array("send"=>"redirect", "text"=>"/adminmain/adminindex" );
				echo json_encode($data);
				exit;
			}else if( $this->auth_admin === NULL ){
				exit;
			}	
		}else{
			$this->fp->setSessionMessage( $this->request->message_name, "ERROR_CAPTCHA_CONTENT" );	
		}	
		
		$data = array("send"=>false, "text"=>$this->fp->getSessionMessage( $this->request->message_name ) );
		echo json_encode($data);
		exit;
	}
	/* login в админку */
	private function login( $login, $password ){
		$this->isAdmin( $login, $password );
		if( $this->auth_admin ){
			if( !session_id() ) session_start();
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			return true;
		}else
			return false;
	}
	/* проверка истенности администратора */
	public function isAdmin( $login=false, $password=false ){
		if( !$login ) $login = isset($_SESSION["login"]) ? $_SESSION["login"] : false;
		if( !$password ) $password = isset($_SESSION["password"]) ? $_SESSION["password"] : false; 
		if( mb_strtolower($login) === mb_strtolower(Config::ADM_LOGIN) && md5($password.Config::SECRET) === Config::ADM_PASSWORD )
			return $this->auth_admin = true;	
		else{
			return $this->auth_admin = NULL;
		}
	}
	public function logout(){
		unset($_SESSION["login"]);
		unset($_SESSION["password"]);
		unset($this->auth_admin);
	}
}
?>