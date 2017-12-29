<tr class="<?=$input->name?>">
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
		<textarea id="<?=$input->name?>" name="<?=$input->name?>" placeholder="<?=$input->default_v?>" <?php if($input->cols) { ?>cols="<?=$input->cols?>"<?php } ?> <?php if($input->rows) { ?>rows="<?=$input->rows?>"<?php } ?> <?php include "jsv.tpl"; ?> ><?=$input->value?></textarea>
	</td>
</tr>