<?php

class UseSEF {
	
	public static function replaceSEF($link, $address = "" ) {
		if ((strpos($link, "//") !== false) && (strpos($link, Config::ADDRESS) === false)) return $link;
		if (strpos($link, Config::ADDRESS) === 0) $link = substr($link, mb_strlen(Config::ADDRESS));
		if ($link === "/") return $address.$link;
		if (preg_match("/^\/\?page=(\d+)$/i", $link, $matches)) return Config::ADDRESS."/page-".$matches[1].Config::SEF_SUFFIX;
		$alias = SefDB::getAliasOnLink($link);
		if ($alias) $link = $address."/".$alias.Config::SEF_SUFFIX;
		else {
			$data = parse_url($link);
			$alias = SefDB::getAliasOnLink($data["path"]);
			if ($alias) $link = $address."/".$alias.Config::SEF_SUFFIX."?".$data["query"];
		}
		return $link;
	}
	
	public static function getRequest($uri) {
		$tmp_uri = $uri;
		if (strpos($uri, Config::ADDRESS) !== false)      // если есть название сайта, то отсекаем его
			$uri = substr($uri, strlen(Config::ADDRESS));
		if ($uri === "/") return $uri;
		$uri = substr($uri, 1); // отсекаем слэш '/' в начале строки
		$uri = str_replace(Config::SEF_SUFFIX, "", $uri); // убираем суффикс ".html"
		if (preg_match("/^page-(\d+)$/i", $uri, $matches)) return "/?page=".$matches[1]; // возврашаем GET параметры page в правильном виде
		$result = SefDB::getLinkOnAlias($uri); // ищем link по alias включающего в себя query часть uri
		if (!$result) { 
			$uri = substr($uri, 0, strpos($uri, "?")); // возвращаем часть uri, расположенную до знака ?
			$result = SefDB::getLinkOnAlias($uri);// ищем link по alias включающего в себя только path часть uri
			if( !$result ) // если никакой вариант link по alias не найден, то возвращаем начальный uri
				$result = $tmp_uri;
		}
		if ($result) return $result;
		return false;
	}
	
	//==== получаем "title" из базы данных по текущему адресу
	public static function getTitle($url) { 
		if (strpos($url, Config::ADDRESS) !== false)      // если есть название сайта, то отсекаем его
			$url = substr($url, strlen(Config::ADDRESS));
		$url = str_replace(Config::SEF_SUFFIX, "", $url);
		if ( strpos($url, "?") !== false )
			return SefDB::getFieldOnField( "title","link",$url );
		else{
			$url = str_replace("/", "", $url);
			return SefDB::getFieldOnField( "title","alias",$url );
		}
	}
	
	//==== получаем поле "desc" из базы данных по текущему адресу
	public static function getDesc($url) { 
		if (strpos($url, Config::ADDRESS) !== false)      // если есть название сайта, то отсекаем его
			$url = substr($url, strlen(Config::ADDRESS));
		$url = str_replace(Config::SEF_SUFFIX, "", $url);
		if ( strpos($url, "?") !== false )
			return SefDB::getFieldOnField( "desc","link",$url );
		else{
			$url = str_replace("/", "", $url);
			return SefDB::getFieldOnField( "desc","alias",$url );
		}
	}
	
	//==== получаем поле "image" из базы данных по текущему адресу
	public static function getImage($url) { 
		if (strpos($url, Config::ADDRESS) !== false)      // если есть название сайта, то отсекаем его
			$url = substr($url, strlen(Config::ADDRESS));
		$url = str_replace(Config::SEF_SUFFIX, "", $url);
		if ( strpos($url, "?") !== false )
			return SefDB::getFieldOnField( "image","link",$url );
		else{
			$url = str_replace("/", "", $url);
			return SefDB::getFieldOnField( "image","alias",$url );
		}
	}
	
}

?>