<?php

class AdminMainController extends AdminController {
	
	//==== Главная страница
	public function actionAdminIndex() {
		$this->title = "Панель администратора ".Config::SITENAME;
		$this->meta_desc = "Панель администратора ".Config::SITENAME;
		$this->meta_key = "администратор,панель,панель администратора,управление лендингом";
				
		$message_name = "adminindex";
		$admin = new Manage();
		$this->auth_admin = $admin->isAdmin(); //делаем проверку на авторизацию админа
		if( $this->auth_admin === NULL ){
			$this->redirect( URL::get("admin") );
		}
		
		$data = OrderDB::getFieldsFromTableCamps( Array("utm_source") );
		$colors = ["#808080","#FF0000","#FFFF00","#00FF00","#00FFFF","#0000FF","#FF00FF","#008000","#800080","#808000"];
		$sectors = array();
		for( $i=0; $i<count($data); $i++ ){
			if( $data[$i] ){
				$where = "camp_id IN (SELECT id FROM mkuz_lan_camps WHERE utm_source='$data[$i]')";	
			}else{
				$where = "camp_id IN (SELECT id FROM mkuz_lan_camps WHERE utm_source IS NULL)";
			}
			//echo "<br>where= ".$where;
			$sectors[$i] = new stdClass;
			$sectors[$i]->camp = $data[$i] ? $data[$i] : "Others";
			$sectors[$i]->percent = OrderDB::getCountIDOnWhere($where) / OrderDB::getCount() * 100;	
			$sectors[$i]->offset = $i ? $sectors[$i-1]->offset - $sectors[$i-1]->percent : 0;
			$sectors[$i]->color = $colors[$i];	
		}
				
		$diagrams = new AdminDiagrams();
		$diagrams->sectors = $sectors;
		
		$index = new AdminIndex();
		$index->title = "Общая статистика ".Config::SITENAME;
		$index->total_orders = OrderDB::getCount();
		$index->confirm_orders = OrderDB::getConfirmOrders() ? OrderDB::getConfirmOrders() : "HET";
		$index->paid_orders = OrderDB::getPaidOrders() ? OrderDB::getPaidOrders() : "НЕТ";
		$index->cancel_orders = OrderDB::getCancelOrders() ? OrderDB::getCancelOrders() : "НЕТ";
		$index->total_summ = OrderDB::getTotalSum() ? OrderDB::getTotalSum() : 0;
		$index->confirm_sum = OrderDB::getConfirmSum() ? OrderDB::getConfirmSum() : 0;
		$index->paid_sum = OrderDB::getPaidSum() ? OrderDB::getPaidSum() : 0;
		$index->cancel_sum = OrderDB::getCancelSum() ? OrderDB::getCancelSum() : 0;
		$index->diagrams = $diagrams;
				
		$this->render( $index );
		
	}
	//==== страница "СТАТИСТИКА"
	public function actionAdminStatistics(){
		$this->title = "Статистика ".Config::SITENAME;
		$this->meta_desc = "Статистика ".Config::SITENAME;
		$this->meta_key = "Статистика";
				
		$message_name = "admin_statistics";
		$admin = new Manage();
		$this->auth_admin = $admin->isAdmin(); //делаем проверку на авторизацию админа
		if( $this->auth_admin === NULL ){
			$this->redirect( URL::get("admin") );
		}
		
		
		$data_st = array();
		$data_st["from"] = $this->request->from;
		$data_st["to"] = $this->request->to;
		$data_st["split"] = $this->request->split;
		$data_st["func"] = $this->request->func;
		$data_st["utm_source"] = $this->request->utm_source;
		$data_st["utm_campaing"] = $this->request->utm_campaing;
		$data_st["utm_content"] = $this->request->utm_content;
		$data_st["utm_term"] = $this->request->utm_term;
		$data_st["ref"] = $this->request->ref;
		$data_st["date"] = $this->request->date;
		$data_st["log"] = $this->request->log;
		
		$where = OrderDB::getWhereForOrders($data_st);
		//echo "<dr>".$where."<br>";	
		//print_r($data_st);
		
		$index = new AdminIndex("admin_statistics");
		$index->title = "Статистика ".Config::SITENAME;
		$index->action = URL::Current();
		$index->method = "POST";
		$index->total_orders = OrderDB::getCountIDOnWhere( $where );
		$index->confirm_orders = OrderDB::getConfirmOrders( $where ) ? OrderDB::getConfirmOrders( $where ) : "HET";
		$index->paid_orders = OrderDB::getPaidOrders( $where ) ? OrderDB::getPaidOrders( $where ) : "НЕТ";
		$index->cancel_orders = OrderDB::getCancelOrders( $where ) ? OrderDB::getCancelOrders( $where ) : "НЕТ";
		$index->total_summ = OrderDB::getTotalSum( $where ) ? OrderDB::getTotalSum( $where ) : 0;
		$index->confirm_sum = OrderDB::getConfirmSum( $where ) ? OrderDB::getConfirmSum( $where ) : 0;
		$index->paid_sum = OrderDB::getPaidSum( $where ) ? OrderDB::getPaidSum( $where ) : 0;
		$index->cancel_sum = OrderDB::getCancelSum( $where ) ? OrderDB::getCancelSum( $where ) : 0;
		$index->data_form = $data_st;
		
		//print_r(OrderDB::getAllDesc());
				
		$this->render( $index );
	}
	
	//==== страница "ЗАКАЗЫ"
	public function actionAdminOrders(){
		$this->title = "Заказы ".Config::SITENAME;
		$this->meta_desc = "Заказы ".Config::SITENAME;
		$this->meta_key = "заказы";
		$message_name = "admin_orders";
		/* блок сохранения данных */
		//print_r($_REQUEST);
		//print_r($this->request);
		if( $this->request->func === "update" || $this->request->func === "save" || $this->request->func === "add" ){
			$data = array( "text"=>"Строка успешно сохранена" );
			echo json_encode($data);
			exit;
			$order_db = new OrderDB();
				
			
			/*--- Формируем массив соответствия ключей базы данных с ключами формы ---*/
			$fields = array( "id",
							 array("name", $this->request->name),
							 array("price", $this->request->price ? $this->request->price : NULL ),
							 array("phone", $this->request->phone),
							 array("email", $this->request->email),
							 array("date_order", $this->request->date_order ? $this->request->date_order : date("Y.m.d G:i:s") ),
							 array("date_confirm", $this->request->date_confirm ? $this->request->date_confirm : NULL ),
							 array("date_pay", $this->request->date_pay ? $this->request->date_pay : NULL ),
							 array("date_cancel", $this->request->date_cancel? $this->request->date_cancel : NULL ),
							 array("camp_id", $_SESSION["camp_id"]),
							 array("split", $_SESSION["split"]),
							 "func"
							
			);
			/*--- удаляем ненужные свойства обьект, чтобы он их не update - тить ---*/
			unset( $order_db->camp_id );
			unset( $order_db->split );
			unset( $order_db->func );
			/*--- Проверяем и записываем данные в таблицу lan_orders ---*/
			$order_db = $this->fp->process($message_name, $order_db, $fields, array(), "SUCCESS_DATA_SAVE");
			
			if( $order_db instanceof OrderDB ){
				$save = true;
				$id = $order_db->id;
			}else{
				$save = false;
				$id = "";
			}
			$data = array(  "func"=>$this->request->func, "text"=>$this->fp->getSessionMessage( $message_name ), "save"=>$save, "id"=>$id   );
			echo json_encode($data);
			exit;
		}else if( $this->request->func === "delete" ){
			$order_db = new OrderDB();
			$order_db->load( $this->request->id );
			$order_db->delete();
				
			$data = array( "func"=>$this->request->func, "text"=>"Строка успешно удалена" );
			echo json_encode($data);
			exit;
		}
		
		
		$admin = new Manage();
		$this->auth_admin = $admin->isAdmin(); //делаем проверку на авторизацию админа
		if( $this->auth_admin === NULL ){
			$this->redirect( URL::get("admin") );
		}
		
		$orders = OrderDB::getAllDesc();
		
		$admin_orders = new AdminOrders();
		$admin_orders->title = "Список заказов ".Config::SITENAME;
		$admin_orders->action = URL::current();
		$admin_orders->orders = $orders;
		
		
		$this->render( $admin_orders);	
	}
}
?>