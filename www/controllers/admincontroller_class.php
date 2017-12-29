<?php

abstract class AdminController extends AbstractController {
	
	protected $title;
	protected $meta_desc;
	protected $meta_key;
	protected $mail = null;
	protected $url_active;
	protected $section_id = 0;
	protected $logo_herbalife ="logo_herbalife.png";
	protected $promo_info = "main_promo_info.tpl";
	protected $promo_img = "f1-melon-front.png";
	protected $promo_top = "main_promo_top.tpl";
	public $all_products = array();
	private static $user_name="";
				
	public function __construct() {
		parent::__construct( new View(Config::DIR_TMPL), new Message(Config::FILE_MESSAGES) );
		$this->mail = new Mail();
		$this->url_active = URL::deleteGET(URL::current(), "page");
	}
	
	//=== страница 404 =======
	public function action404() {
		header("HTTP/1.1 404 Not Found");
		header("Status: 404 Not Found");
		$this->title = "Страница не найдена - 404";
		$this->meta_desc = "Запрошенная страница не существует.";
		$this->meta_key = "страница не найдена, страница не существует, 404";
		
		$pm = new PageMessage();
		$pm->header = "Land-os.ru";
		$pm->text = "Ошибка 404. Запрошенная страница не существует.";
		$this->render($pm);
	}
	
	public function inDeveloping() {
		$this->title = "Страница в разработке";
		$this->meta_desc = "Запрошенная страница в разработке.";
		$this->meta_key = "страница в разработке, разработка страницы";
		
		$hornav = $this->getHornav();
		$hornav->addData("Страница в разработке");
				
		$developing = new InDeveloping();
		$developing->title = "Страница в разработке";
		$developing->hornav = $hornav;
		$developing->link = URL::get("");
				
		$this->render($developing);
	}
	
	protected function accessDenied() {
		$this->title = "Доступ закрыт!";
		$this->meta_desc = "Доступ к данной странице закрыт.";
		$this->meta_key = "доступ закрыт, доступ закрыт страница, доступ закрыт страница 403";
		
		$pm = new PageMessage();
		$pm->header = "Доступ закрыт!";
		$pm->text = "У Вас нет прав доступа к данной странице.";
		$this->render($pm);
	}
	
	final protected function render($str) {
		$params = array();
		$params["head"] = $this->getHeader();
		$params["topmenu"] = $this->getTop();
		$params["content"] = $str;
		$params["footer"] = $this->getFooter();
		$this->view->render(Config::LAYOUT_ADMIN, $params);
	}
	
	protected function getHeader() {
		$header = new Header();
		$header->title = $this->title;
		$header->meta("Content-Type", false, "text/html; charset=utf-8", true);
		$header->meta("description", false, $this->meta_desc, false);
		$header->meta("keywords", false, $this->meta_key, false);
		$header->meta("viewport", false, "width=device-width", false);
		$header->meta("robots", false, "index, follow", false);
		$header->favicon = "http://land-os.ru/favicon.ico";
		$header->favicon_1 = "http://land-os.ru/favicon.ico";
		$header->css = array("/styles/main_admin.css");
		$header->js = array("/js/jquery-1.10.2.min.js", "/js/ajax.js", "/js/dispatcher.js", "/js/functions.js", "/js/adminfunction.js", "/js/stack.js", "/js/jquery.appear.js");
		return $header;
	}
		
	protected function getFooter(){
		$footer = new Footer();
		return $footer;
	}
	protected function getLogo($logo_img){
		$logo = new Logo();
		$logo->img = Config::DIR_IMG.$logo_img;
		return $logo;
	}
	
	protected function getTop() {
		$items = MenuDB::getTopMenuAdmin();
		$topmenu = new TopMenu();
		$topmenu->uri = $this->url_active;
		$topmenu->items = $items;
		return $topmenu;
	}
}

?>