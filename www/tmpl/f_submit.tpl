<tr>
	<?php if( $input->label_pos == "<td>" ) {?>
		<td>
		</td>
	<?php } ?>
	<td <?php if( $input->colspan ){ ?>colspan="<?=$input->colspan?>"<?php } ?> >
		<input type="submit" name="<?php if ($input->name) { ?><?=$input->name?><?php } else { ?><?=$name?><?php } ?>" value="<?=$input->value?>" <?php if (isset($jsv[$input->name])) { ?>data-tconfirm="<?=$jsv[$input->name]->t_confirm?>"<?php } ?> />
	</td>
</tr>
