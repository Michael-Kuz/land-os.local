<tr>
	<?php if( $input->label && $input->label_pos == "<td>" ) {?>
		<td>
			<label for="<?=$input->name?>"><?=$input->label?></label>
		</td>
	<?php } ?>	
	<td <?php if( $input->colspan ){ ?>colspan="<?=$input->colspan?>"<?php } ?>>
		<?php if( $input->label && $input->label_pos == "<p>" ){?>
			<p>
				<label for="<?=$input->name?>"><?=$input->label?></label>
			</p>
		<?php } ?>
		<input type="text" name="<?=$input->name?>" id="<?=$input->name?>" value="<?=$input->value?>" placeholder="<?=$input->default_v?>" <?php include "jsv.tpl"; ?> />
	</td>	
</tr>
<tr class="captcha">
	<?php if( $input->label && $input->label_pos == "<td>" ) {?>
		<td>
		</td>
	<?php } ?>
	<td <?php if( $input->colspan ){ ?>colspan="<?=$input->colspan?>"<?php } ?> >
		<img src="/images/update.png" alt="Обновить" />
		<img src="../captcha.php" alt="Капча" />
	</td>	
</tr>