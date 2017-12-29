<tr>
	<?php if( $input->label && $input->label_pos == "<td>" ){?>
		<td>
			<label for="<?=$input->name?>"><?=$input->label?></label>
		</td>
	<?php } ?>
	<td <?php if( $input->colspan ){ ?>colspan="<?=$input->colspan?>"<?php } ?> >
		<?php if( $input->label && $input->label_pos == "<p>" ){?>
			<p>
				<label for="<?=$input->name?>"><?=$input->label?></label>
			</p>
		<?php } ?>
		<input id="<?=$input->name?>" type="text" name="<?=$input->name?>" value="<?=$input->value?>" placeholder="<?=$input->default_v?>" <?php include "jsv.tpl"; ?> />
	</td>
</tr>