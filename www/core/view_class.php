<?php
//=================== Шаблонизатор ================
class View {
	
	private $dir_tmpl;
	
	public function __construct($dir_tmpl) {
		$this->dir_tmpl = $dir_tmpl;
	}
	// $file - имя tpl файла
	// $params - массив параметров которы будут подставляться в tpl файл
	// $return (false - выводим на экран, true - возвращаем просто строку)
	// extract преобразуе массив вида array("id"=>5, "title"=>"Главная") в обычные переменные $id=5, $title="Главная" и таким
	// образом они автоматически подставляются в tpl файле
	public function render($file, $params, $return = false) {
		$template = $this->dir_tmpl.$file.".tpl";
		extract($params);
		ob_start();
		include($template);
		if ($return) return ob_get_clean();
		else echo ob_get_clean();
	}
}

?>