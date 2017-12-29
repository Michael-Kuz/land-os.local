<?php

class MainController extends Controller {
	
	//==== Главная страница
			
	public function actionIndex() {
		$this->title = "Создание и продвижение Лендинга под ключ без предоплаты";
		$this->meta_desc = "Создание и продвижение Лендинга под ключ без предоплаты";
		$this->meta_key = "лендинг, создание лендинга, создание лендинга без предоплаты, создание лендинга под ключ без предоплаты, мультилендинг";
		//phpinfo();
		/*--- Фрагмент реализации сплит тестирования ---*/
		//unset($_SESSION["split"]);
		if( !isset($_SESSION["split"]) || !$_SESSION["split"] ){
			$values = array("anima", "no_anima");
			$rand = mt_rand( 0, count($values)-1 );
			$_SESSION["split"] = $values[$rand];
		}
			
		
		/*--- фрагмент формирования данных для таблицы lan_camps ---*/
		if( !isset($_SESSION["camp_id"]) || !$_SESSION["camp_id"] ){
			$camp = new CampsDB();
			$camp->ip = ip2long($_SERVER["REMOTE_ADDR"]);
			$camp->utm_source = $this->request->utm_source ? $this->request->utm_source : NULL;
			$camp->utm_campaing = $this->request->utm_campaing ? $this->request->utm_campaing : NULL;
			$camp->utm_content = $this->request->utm_content ? $this->request->utm_content : NULL;
			$camp->utm_term = $this->request->utm_term ? $this->request->utm_term : NULL;
			$camp_id = $camp->getCampID();
			if( !$camp_id ){
				$camp->ip = $_SERVER["REMOTE_ADDR"];
				$camp->ref = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : NULL;
				$camp->date = date("d.m.Y G:i:s");
				$camp->save();
				$camp_id = $camp->getID();
			}
			$_SESSION["camp_id"] = $camp_id;
		}
		
		/*=== считываем данные по каждой секции лендинга ===*/
		$content = new ContentDB();
		$works = new WorksDB();
		/*=== формируем и обрабатываем запросы с форм ===*/
						
		$form_top = new Form("top_form"); //форма в верхней части страницы
		$form_top->addDIV( array("form_name", "phone", "email") );
		//$form_top->action = URL::get("function.php");
		$form_top->form_name = "call_back";
		$form_top->name = $this->request->name;
		$form_top->phone = $this->request->phone;
		$form_top->email = $this->request->email;
				
		$form_bottom =new Form("bottom_form"); //форма в нижней части страницы
		$form_bottom->action = URL::get("function.php");
		$form_bottom->addDIV( array("form_name", "phone", "email") );
		$form_bottom->form_name = "call_back";
		$form_bottom->name = $this->request->name;
		$form_bottom->phone = $this->request->phone;
		$form_bottom->email = $this->request->email;
						
		$index = new Index();
		$index->title = "Landing page под ключ без предоплаты";
		if( $this->request->utm_term ){
			$headline = HeadlinesDB::getHeadline($this->request->utm_term);
			if( $headline )
				$index->title = $headline;
		}	
		$index->items_adv = $content->getSectionLanding( 1 );
		$index->items_stp = $content->getSectionLanding( 2 );
		$index->items_eff = $content->getSectionLanding( 3 );
		$index->items_works = $works->getWorks();
		$index->items_guar = $content->getSectionLanding( 4 );
		$index->top_form = $form_top;
		$index->bottom_form = $form_bottom;
		$index->split = $_SESSION["split"];
		
		$this->render( $index );
	}
	
	/*--- Вход в админ панель ---*/
	public function actionAdmin(){
		$this->title = "Авторизации администратора ".Config::SITENAME;
		$this->meta_desc = "Авторизация администратора для входа в панель управления лендинга ".Config::SITENAME;
		$this->meta_key = "авторизация, администратор, авторизация администратора";
		
		$message_name = "admin";
		$admin = new Manage();
		$this->auth_admin = $admin->isAdmin();
		if( $this->auth_admin === NULL ){
			$form_admin = new Form("admin_form"); //форма фвторизации администратора
			$form_admin->name = "admin_auth";
			$form_admin->action = URL::get("function.php");
			$form_admin->header = "Авторизация администратора ".Config::SITENAME; 
			$form_admin->message = $message_name;
			
			$this->render($form_admin);
		}elseif( $this->auth_admin !== NULL ){
			$this->redirect( URL::get("adminindex","adminmain") );
		}
	}
}
?>