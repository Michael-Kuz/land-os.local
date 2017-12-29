<div class="diagram">
	<?php echo json_encode($sectors); ?>
	<svg class="diagram-pie" viewBox="0 0 32 32">
		<?php $i = 0; ?>
		<?php foreach( $sectors as $sector ) {?>
			<circle r="16" cx="16" cy="16" stroke-width="32px" stroke-dashoffset="<?=$sector->offset?>" stroke-dasharray="<?=$sector->percent?> 158" stroke="<?=$sector->color?>" class="w-pie diagram-pie-circle-<?=$i?>"/>
			<?php $i++; ?>	
		<?php } ?>
	</svg>
</div>