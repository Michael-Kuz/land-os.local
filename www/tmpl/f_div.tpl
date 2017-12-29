<tr>
	<td <?php if( $input->colspan ){ ?>colspan="<?=$input->colspan?>"<?php } ?> >
		<div class="<?=$input->name?>">
			<?php if( $ForFreeDelivery == Config::SUMM_FOR_FREE_DELIVERY ) { ?>
			Чтобы получить бесплатную доставку в постамат или курьером, необходимо сделать заказ на сумму не менее <b><?=$ForFreeDelivery?> <?=$suffix?>.</b> (данная акция не распространяется на протеиновые батончики)
			<?php } elseif( $ForFreeDelivery > 0 && $ForFreeDelivery < Config::SUMM_FOR_FREE_DELIVERY ) { ?>
			Чтобы получить бесплатную доставку в постамат или курьером, необходимо добавить в заказ продукты на сумму <b><?=$ForFreeDelivery?> <?=$suffix?>.</b> (данная акция не распространяется на протеиновые батончики)
			<?php } elseif( $ForFreeDelivery == 0 ) {  ?>
			Вы можете воспользоваться бесплатной доставкой в постамат или бесплатной доставкой курьером.
			<?php } ?>
		</div>
	</td>
</tr>