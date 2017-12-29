<head>
	<title><?=$title?></title>
	<?php foreach ($meta as $m) { ?>
		<meta <?php if ($m->http_equiv) { ?>http-equiv="<?=$m->name?>" <?php } elseif($m->name) { ?>name="<?=$m->name?>"<?php } ?> <?php if($m->property) { ?>property="<?=$m->property?>"<?php } ?> content="<?=$m->content?>" />
	<?php } ?>
	<?php if ($favicon) { ?>
		<link href="<?=$favicon?>" rel="shortcut icon" type="image/png" />
	<?php } ?>
	<?php if ($favicon_1) { ?>
		<link href="<?=$favicon_1?>" rel="icon" type="image/png" />
	<?php } ?>
	<?php foreach ($css as $href) { ?>
		<link type="text/css" rel="stylesheet" href="<?=$href?>" />
	<?php } ?>
	<?php foreach ($js as $src) { ?>
		<script type="text/javascript" src="<?=$src?>"></script>
	<?php } ?>
	<!--<script type="text/javascript">   
		 document.onkeydown=key; 
		 function key() 
		 { 
		   	window.status=event.keyCode; 
			if(event.keyCode==85)return false; //клавиша С
			if(event.keyCode==17)return false; //клавиша Ctrl
			if(event.keyCode==16)return false; //клавиша Shift
			if(event.keyCode==73)return false; //клавиша I
			if(event.keyCode==123)return false; //клавиша F12
		 } 
		  function blockMenu() {   //правая кнопка мыши    
		 }
		  document.oncontextmenu = function()  { blockMenu(); return false; };
	 </script>-->
</head>