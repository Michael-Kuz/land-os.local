<?php function printItem($item, &$items, $childrens, $active) { ?>
	<?php if (count($items) == 0) return; ?>
	<li>
		<a <?php if (in_array($item->id, $active)) { ?>class="active"<?php } ?> <?php if ($item->external) { ?>rel="external"<?php } ?> href="<?=$item->link?>">
			<span><?=$item->title?></span>
		</a>
		<?php
			while(true) {
				$key = array_search($item->id, $childrens);
				if (!$key) break;
				unset($childrens[$key]);
		?>
		<?=printItem($items[$key], $items, $childrens, $active)?>
		<?php } ?>
	</li>
<?php unset($items[$item->id]); } ?>