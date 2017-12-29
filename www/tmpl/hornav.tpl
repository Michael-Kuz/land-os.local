<div class="hornav">
	<?php $first = true; foreach ($data as $d) { ?>
		<?php if (!$first) { ?><img src="/images/hornav_arrow.png" alt="разделительная стрелка" title="разделительная стрелка" /><?php } ?>
		<?php if ($d->link) { ?><a href="<?=$d->link?>"><?=$d->title?></a><?php } else { ?><p><?=$d->title?></p><?php } ?>
	<?php $first = false; } ?>
</div>

