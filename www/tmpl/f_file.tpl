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
		<input type="file" id="<?=$input->name?>" name="<?=$input->name?>" value="<?=$input->value?>" <?php if ($check) { ?>onchange = "return checkFile(this)"<?php } ?> <?php include "jsv.tpl"; ?> />
	</td>
</tr>