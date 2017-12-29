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
		<input type="password" name="<?=$input->name?>" id="<?=$input->name?>" placeholder="<?=$input->default_v?>" <?php include "jsv.tpl"; ?> />
	</td>
</tr>