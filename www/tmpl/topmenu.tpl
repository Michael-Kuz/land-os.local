<nav>
	<div class="top-menu">
		<label class="top-menu-toggle" for="menuToggle">&equiv;</label>
		<input type="checkbox" id="menuToggle"/>
		<div class="top-menu-nav">
			<?php foreach( $items as $item ) { ?>
				<a class="top-menu-nav-item link-effect-1 <?php if($item->link == $uri) {?>active<?php } ?>" href="<?=Config::ADDRESS?><?=$item->link?>" <?php if($item->link == "#") { ?>id="popup"<?php } ?>><?=$item->title?></a>
			<?php } ?>
		</div>
	</div>
</nav>